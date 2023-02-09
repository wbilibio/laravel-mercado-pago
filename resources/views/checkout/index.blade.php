@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <a href="https://www.perfectpay.com.br" class="logo">
                    <img class="d-block mx-auto mb-4" src="{{ asset('images/logo-original.png') }}" alt="">
                </a>
                <h2>Checkout</h2>
                <p class="lead">Insira seus dados abaixo e finalize seu pagamento</p>
            </div>
            <livewire:form-checkout />
        </main>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script type="text/javascript">
        const mp = new MercadoPago("{{env('MP_PUBLIC_KEY')}}");

        $('#zipcode').mask('00000-000');

        function showSectionCredit(){
            if($("input[name='payment_method_id']:checked").val() === 'bolbradesco'){
                $('.box-credito').removeClass('active');
            } else {
                $('.box-credito').addClass('active');
                startCreditCard();
            }
        }
        showSectionCredit();

        function startCreditCard(){
            const cardNumberElement = mp.fields.create('cardNumber', {
                placeholder: "Número do cartão"
            }).mount('cardNumber');

            const expirationDateElement = mp.fields.create('expirationDate', {
                placeholder: "MM/YY",
            }).mount('expirationDate');

            const securityCodeElement = mp.fields.create('securityCode', {
                placeholder: "Código de segurança"
            }).mount('securityCode');

            cardNumberElement.on('binChange', getPaymentMethods);
            expirationDateElement.on('change', createCardToken);
            securityCodeElement.on('change', createCardToken);
            $('#identificationNumber').on("input", createCardToken);
            $('#cardHolderName').on("input", createCardToken);

            async function getPaymentMethods(data) {
                const { bin } = data
                const { results } = await mp.getPaymentMethods({ bin });
                if(results.length){
                    $("#cardNumber").before('<img src="'+results[0].thumbnail+'" class="brand" />');
                    $('#credito').val(results[0].id);
                    await getIssuers(results[0].id, bin);
                    await getInstallments(results[0].id,bin);
                    await createCardToken();
                }
            }

            async function getIssuers(paymentMethodId, bin) {
                const issuears = await mp.getIssuers({paymentMethodId, bin });
                $('#issueId').val(issuears[0].id);
            };

            async function getInstallments(paymentMethodId, bin) {
                const installments = await mp.getInstallments({
                    amount: document.getElementById('transactionAmount').value,
                    bin,
                    paymentTypeId: 'credit_card'
                });
                const selectInstallments = document.getElementById('installments');

                installments[0].payer_costs.forEach((payer_cost) => {
                    option = new Option(payer_cost.recommended_message, payer_cost.installments);
                    selectInstallments.options[selectInstallments.options.length] = option;
                });
            };

            async function createCardToken(data){
                const cardholderName = document.getElementById('cardHolderName').value;
                const identificationType = document.getElementById('identificationType').value;
                const identificationNumber = document.getElementById('identificationNumber').value;
                if(cardholderName && identificationType && identificationNumber){
                    const token = await mp.fields.createCardToken({
                        cardholderName,
                        identificationType,
                        identificationNumber,
                    });
                    if(token.id){
                        $('#tokenCard').val(token.id);
                    }
                }
            }
        }
    </script>
@endpush
