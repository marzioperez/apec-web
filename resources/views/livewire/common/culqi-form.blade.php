<div x-data="{
        loading: false,
        error: null,
        culqi_token: null,
        init() {
            Culqi.open();
        }
    }"
    x-on:set-error.window="error = $event.detail.error; loading = false;"
    x-on:unloading.window="loading = false;"
    x-on:start-3ds.window="Culqi3DS.initAuthentication($event.detail.token); culqi_token = $event.detail.token;"
    x-on:message.window="
        if ($event.origin === window.location.origin) {
            const response = event.data;
            if (response.parameters3DS) {
                $dispatch('process-3ds', {data: response.parameters3DS, token: culqi_token});
            }
        }
    ">
    <div id="culqi-container" class="h-[720px]"></div>

    <div id="culqi-loader" class="flex justify-center" style="display: none;">
        <div>
            <div class="loading mb-3"></div>
            <span class="text-center">Cargando...</span>
        </div>
    </div>

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
            lang: 'en',
            installments: false,
            modal: false,
            container: "#culqi-container", // Opcional - Div donde quieres cargar el checkout
            paymentMethods: paymentMethods,
            paymentMethodsSort: Object.keys(paymentMethods), // las opciones se ordenan según se configuren en paymentMethods
        }

        let loader = document.getElementById('culqi-loader');

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
                loader.style.display = loader.style.display === 'none' ? '' : 'none';
                window.dispatchEvent(new CustomEvent('get-token', {detail: {token: token_id}}));
            } else if (Culqi.order) {
                Culqi.close();
                const order = Culqi.order;
                console.log('Se ha creado el objeto Order: ', order);
            } else {
                window.dispatchEvent(new CustomEvent('set-error', {detail: {error: Culqi.error['user_message']}}));
            }
        }

        Culqi.culqi = handleCulqiAction;
    </script>

    <script src="https://3ds.culqi.com"></script>
    <script>
        Culqi3DS.publicKey = '{{config('services.culqi.key')}}';

        Culqi3DS.options = {
            showModal: true,
            showLoading: true,
            showIcon: true,
            closeModalAction: function(){
                window.location.reload();
            },
        };

        Culqi3DS.settings = {
            charge: {
                totalAmount: {{$amount*100}},
                returnUrl: "{{config('app.url')}}",
                currency: "USD"
            },
            card: {
                email: "{{auth()->user()->email}}",
            },
        };
    </script>
@endpush
