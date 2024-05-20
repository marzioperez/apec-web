<div x-data="{
    loading: false,
    error: null,
    init() {
        Culqi.publicKey = '{{config('services.culqi.key')}}';
        Culqi.settings({
            title: '{{config('app.name')}}',
            currency: 'USD',
            description: 'Payment - {{config('app.name')}}',
            amount: 6000
        });

        Culqi.options({
            paymentMethods: {
                tarjeta: true,
                bancaMovil: false,
                agente: false,
                billetera: false,
                cuotealo: false,
                yape: false
            }
        });
    },
    processForm() {
        Culqi.validationPaymentMethods();
        let paymentTypeAvailable = Culqi.paymentOptionsAvailable;
        this.loading = true;
        this.error = null;
        if (paymentTypeAvailable.token.available) {
            paymentTypeAvailable.token.generate();
        }
    }
}"
    x-on:set-error.window="error = $event.detail.error; loading = false;"
    x-on:unloading.window="loading = false;">
    <form class="px-5 py-6 bg-white shadow-lg rounded-xl">
        <div class="form-group inline-fields">
            <label>Email</label>
            <input type="text" size="50" data-culqi="card[email]" id="card[email]">
        </div>
        <div class="form-group inline-fields">
            <label>Card number</label>
            <input type="text" size="20" data-culqi="card[number]" id="card[number]">
        </div>
        <div class="grid grid-cols-3 gap-3">
            <div class="form-group inline-fields">
                <label>CVV</label>
                <input type="text" size="4" data-culqi="card[cvv]" id="card[cvv]">
            </div>
            <div class="form-group inline-fields">
                <label>Exp. Date (MM/YYYY)</label>
                <div class="flex space-x-3 items-center">
                    <input type="text" size="2" data-culqi="card[exp_month]" id="card[exp_month]">
                    <span>/</span>
                    <input type="text" size="4" data-culqi="card[exp_year]" id="card[exp_year]">
                </div>
            </div>
            <div class="form-group inline-fields">
                <label>Cuotas</label>
                <select class="!py-2.5" disabled id="card[installments]">
                    <option value="1">Select...</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-center space-x-6">
            <div><img src="{{asset('img/visa.svg')}}" class="h-[20px]"></div>
            <div><img src="{{asset('img/mastercard.svg')}}" class="h-[30px]"></div>
            <div><img src="{{asset('img/american-express.svg')}}" class="h-[30px]"></div>
            <div><img src="{{asset('img/diners.svg')}}" class="h-[40px]"></div>
        </div>
    </form>

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

    <button type="button" class="btn btn-primary mt-3" x-bind:disabled="loading" x-on:click.prevent="processForm()">
        <i class="fa-duotone fa-spinner-third fa-spin" x-show="loading"></i>
        <span x-show="loading">Please wait...</span>
        <span x-show="!loading">Pay now ${{number_format($amount)}}</span>
    </button>
</div>
@push('scripts')
    <script src="https://checkout.culqi.com/js/v4"></script>
    <script>
        function culqi() {
            if (Culqi.token) {
                const token_id = Culqi.token.id;
                window.dispatchEvent(new CustomEvent('get-token', {detail: {token: token_id}}));
            } else {
                window.dispatchEvent(new CustomEvent('set-error', {detail: {error: Culqi.error['user_message']}}));
            }
        }
    </script>
@endpush
