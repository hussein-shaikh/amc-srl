<style>
    html {
        font-size: 14px;
    }

    @media (min-width: 768px) {
        html {
            font-size: 16px;
        }
    }

    .container {
        max-width: 960px;
    }

    .pricing-header {
        max-width: 700px;
    }

    .card-deck .card {
        min-width: 220px;
    }

    .border-top {
        border-top: 1px solid #e5e5e5;
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }
</style>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 m-auto ms-2 font-weight-normal">{{ config('app.name') }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('category') }}" :active="request() - > routeIs('category')">Categories</a>
        <a class="p-2 text-dark" href="{{ route('product') }}" :active="request() - > routeIs('product')">Product</a>
    </nav>

    <span style="
        float: right;
        text-align: right;
        padding-left: 63%;
    ">
        Hi, {{ Auth::user()->name }}
    </span>
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf

        <x-jet-dropdown-link class="btn btn-outline-primary right" href="{{ route('logout') }}"
            @click.prevent="$root.submit();">
            {{ __('Log Out') }}
        </x-jet-dropdown-link>
    </form>

</div>
