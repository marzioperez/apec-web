<div x-data="{
        loading: false,
        error: null,
        init() {
            Culqi.open();
        }
    }"
    x-on:set-error.window="error = $event.detail.error; loading = false;"
    x-on:unloading.window="loading = false;">
    <div id="culqi-container" class="h-[720px]"></div>

    <div class="rounded-md bg-red-50 p-4 mt-3" x-show="error">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Error</h3>
                <div class="mt-2 text-sm text-red-700" x-html="error"></div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script src="https://js.culqi.com/checkout-js"></script>
    <script>
        const settings = {
            title: 'Payment - {{config('app.name')}}',
            currency: 'USD',
            amount: {{$amount * 100}}
        }
        const client = {
            email: '{{auth()->user()->email}}',
        }

        const paymentMethods = {
            tarjeta: true,
            yape: false,
            billetera: false,
            bancaMovil: false,
            agente: false,
            cuotealo: false,
        }

        const options = {
            lang: 'auto',
            installments: false,
            modal: false,
            container: "#culqi-container", // Opcional - Div donde quieres cargar el checkout
            paymentMethods: paymentMethods,
            paymentMethodsSort: Object.keys(paymentMethods), // las opciones se ordenan según se configuren en paymentMethods
        }

        const appearance = {
            theme: "default",
            hiddenCulqiLogo: false,
            hiddenBannerContent: false,
            hiddenBanner: false,
            hiddenToolBarAmount: false,
            menuType: "sidebar", // sidebar / sliderTop / select
            buttonCardPayText: "Process payment", //
            logo: 'https://apecceosummit2024.com/img/favicon.png',
            defaultStyle: {
                bannerColor: "#000000",
                buttonBackground: "#009600",
                menuColor: "pink",
                linksColor: "#75B42E",
                buttonTextColor: "#FFFFFF",
                priceColor: "#000000",
            },
        };

        const config = {
            settings,
            client,
            options,
            appearance,
        };

        const publicKey = '{{config('services.culqi.key')}}';
        const Culqi = new CulqiCheckout(publicKey, config);

        const handleCulqiAction = () => {
            if (Culqi.token) {
                const token_id = Culqi.token.id;
                Culqi.close();
                window.dispatchEvent(new CustomEvent('get-token', {detail: {token: token_id}}));
            } else if (Culqi.order) { // ¡Objeto Order creado exitosamente!
                Culqi.close();
                const order = Culqi.order;
                console.log('Se ha creado el objeto Order: ', order);
            } else {
                window.dispatchEvent(new CustomEvent('set-error', {detail: {error: Culqi.error['user_message']}}));
            }
        }

        Culqi.culqi = handleCulqiAction;
    </script>
@endpush
