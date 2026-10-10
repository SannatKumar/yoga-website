"""Compress images for the web, in place. Requires Pillow (`pip install pillow`).

Usage:
    python scripts/compress-images.py public/images/yogasana_pictures/new_pose.jpeg [more files...]
    python scripts/compress-images.py --to-jpeg public/images/some_photo.png   # converts, deletes the .png

Rules (see docs/DEPLOYMENT_PLAN.md, "Images"):
- JPEG: apply EXIF rotation, shrink so the longest side is <= --max px (default 1600),
  re-save at quality 82, progressive, metadata stripped. Skipped if it wouldn't get smaller.
- PNG: lossless re-optimise only (shrunk to --max as well). Logos keep their transparency.
- --to-jpeg: for opaque photos saved as PNG. Writes name.jpg next to it and deletes the PNG —
  update every reference to the old path (code, and the `images` table via a data-only migration).

Run it on every new photo before committing it — phone photos are ~3000x4000 / 1-2 MB, the site
never shows them larger than ~800px.
"""

import argparse
import os
import sys

from PIL import Image, ImageOps


def save_jpeg(im, path):
    im = ImageOps.exif_transpose(im).convert('RGB')
    im.thumbnail((args.max, args.max), Image.LANCZOS)
    im.save(path, 'JPEG', quality=82, optimize=True, progressive=True)


def process(path):
    before = os.path.getsize(path)
    root, ext = os.path.splitext(path)
    ext = ext.lower()
    im = Image.open(path)
    im.load()

    if args.to_jpeg:
        if ext != '.png':
            sys.exit(f'--to-jpeg expects .png files: {path}')
        if 'A' in im.getbands() and im.getchannel('A').getextrema()[0] < 255:
            sys.exit(f'{path} has real transparency — keep it as PNG')
        target = root + '.jpg'
        save_jpeg(im, target)
        os.remove(path)
        print(f'{path} -> {target}: {before // 1024} KB -> {os.path.getsize(target) // 1024} KB')
        return

    tmp = root + '.tmp' + ext
    if ext in ('.jpg', '.jpeg'):
        save_jpeg(im, tmp)
    elif ext == '.png':
        im.thumbnail((args.max, args.max), Image.LANCZOS)
        im.save(tmp, 'PNG', optimize=True)
    else:
        print(f'skip (unsupported): {path}')
        return

    after = os.path.getsize(tmp)
    if after < before:
        os.replace(tmp, path)
        print(f'{path}: {before // 1024} KB -> {after // 1024} KB')
    else:
        os.remove(tmp)
        print(f'{path}: already small ({before // 1024} KB), unchanged')


parser = argparse.ArgumentParser(description='Compress images for the web, in place.')
parser.add_argument('files', nargs='+')
parser.add_argument('--max', type=int, default=1600, help='longest side in px (default 1600)')
parser.add_argument('--to-jpeg', action='store_true', help='convert opaque PNG photos to .jpg')
args = parser.parse_args()

for f in args.files:
    process(f)
