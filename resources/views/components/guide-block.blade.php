@props(['title', 'text', 'reference' => null])

<div class="guide-block">
    <h2 class="guide-title">{{ $title }}</h2>
    <p class="guide-text">{{ $text }}</p>
    @if ($reference)
        <div class="guide-ref">— {{ $reference }}</div>
    @endif
</div>


<style>
    .guide-block {
        position: relative;
        background-color: #fff;
        border-left: 6px solid #22c55e;
        border-right: 6px solid #3B82F5;

        /* border-radius: 0 0 12px 12px; */

        border-radius: 20%/50px 0px 12px 0;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        transition: box-shadow 0.2s ease;
        overflow: hidden;
    }




    .guide-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #15803d;
        margin-bottom: 1rem;
        text-align: center;
    }

    .guide-text p {
        font-size: 1.05rem;
        color: #222;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .guide-ref {
        font-style: italic;
        color: #555;
        text-align: right;
        font-size: 0.95rem;
        margin-top: 1rem;
    }



    @media (max-width: 575.98px) {

        .guide-block {
            position: relative;
            background-color: #000;
            border-left: 6px solid #22c55e;
            border-right: 6px solid #3B82F5;

            /* border-radius: 0 0 12px 12px; */

            border-radius: 20%/50px 0px 12px 0;
            padding: 5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .guide-title {
            /* font-size: 1.25rem; */
            font-weight: bold;
            color: #15803d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .guide-text p {
            font-size: 1.05rem;
            color: #222;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .guide-ref {
            font-style: italic;
            color: #555;
            text-align: right;
            /* font-size: 0.95rem; */
            margin-top: 1rem;
        }

    }

    /* Small devices (phones, ≥ 576px and < 768px) */
    @media (min-width: 576px) and (max-width: 767.98px) {

        .guide-block {
            width: 100%;
            position: relative;
            background-color: #000;
            border-left: 6px solid #22c55e;
            border-right: 6px solid #3B82F5;

            /* border-radius: 0 0 12px 12px; */

            border-radius: 20%/50px 0px 12px 0;
            padding: 5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .guide-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #15803d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .guide-text p {
            font-size: 1.05rem;
            color: #222;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .guide-ref {
            font-style: italic;
            color: #555;
            text-align: right;
            font-size: 0.95rem;
            margin-top: 1rem;
        }

    }

    /*This is my One plus */
    /* Medium devices (tablets, ≥ 768px and < 992px) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .guide-block {
            height: 400px;
            width: 99%;
            position: relative;
            background-color: #fff;
            border-left: 6px solid #22c55e;
            border-right: 6px solid #3B82F5;

            /* border-radius: 0 0 12px 12px; */

            border-radius: 20%/50px 0px 12px 0;
            padding: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 5 rem 2rem;
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .guide-title {
            font-size: 50px;
            font-weight: bold;
            color: #15803d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .guide-text {
            font-size: 40px;
        }

        /* .guide-text p {
    font-size: 40px;
    color: #222;
    line-height: 1.6;
    margin-bottom: 1rem;
} */

        .guide-ref {
            font-style: italic;
            color: #555;
            text-align: right;
            font-size: 2rem;
            margin-top: 1rem;
        }


    }

    /* Large devices (laptops/desktops, ≥ 992px and < 1200px) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .guide-block {
            position: relative;
            background-color: #fff;
            border-left: 6px solid #22c55e;
            border-right: 6px solid #3B82F5;

            /* border-radius: 0 0 12px 12px; */

            border-radius: 20%/50px 0px 12px 0;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .guide-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #15803d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .guide-text p {
            font-size: 1.05rem;
            color: #222;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .guide-ref {
            font-style: italic;
            color: #555;
            text-align: right;
            font-size: 0.95rem;
            margin-top: 1rem;
        }

    }

    /* Extra large devices (large desktops, ≥ 1200px) */
    @media (min-width: 1200px) {
        .guide-block {
            position: relative;
            background-color: #fff;
            border-left: 6px solid #22c55e;
            border-right: 6px solid #3B82F5;

            /* border-radius: 0 0 12px 12px; */

            border-radius: 20%/50px 0px 12px 0;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .guide-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #15803d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .guide-text p {
            font-size: 1.05rem;
            color: #222;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .guide-ref {
            font-style: italic;
            color: #555;
            text-align: right;
            font-size: 0.95rem;
            margin-top: 1rem;
        }

    }
</style>
