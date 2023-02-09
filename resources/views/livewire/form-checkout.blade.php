<form id="form-checkout"  method="POST" action="{{ route('checkout.store') }}">
    @csrf
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            Não foi possível realizar seu pagamento, tente mais tarde.
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            OPS! Preencha todos os campos para prosseguir.
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <h4 class="mb-3">Dados pessoais</h4>
            <div class="row g-3">
                <div class="col-sm-6 mb-2">
                    <label for="first_name" class="form-label">Primeiro nome</label>
                    <input name="payer[first_name]" type="text" id="first_name" value="{{ old('payer.first_name') }}" class="form-control" />
                    @error('payer.first_name')
                    <div class="invalid-feedback">
                        Preencha com seu nome.
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-2">
                    <label for="last_name" class="form-label">Último nome</label>
                    <input name="payer[last_name]" type="text" id="last_name" value="{{ old('payer.last_name') }}" class="form-control" />
                    @error('payer.last_name')
                    <div class="invalid-feedback">
                        Preencha seu último nome.
                    </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-2">
                    <label for="ddd" class="form-label">(DD)</label>
                    <input name="additional_info[payer][phone][area_code]" value="{{ old('additional_info.payer.phone.area_code') }}" type="number" id="ddd" class="form-control" />
                    @error('additional_info.payer.phone.area_code')
                    <div class="invalid-feedback">
                        DDD inválido
                    </div>
                    @enderror
                </div>
                <div class="col-md-9 mb-2">
                    <label for="phone" class="form-label">Telefone</label>
                    <input name="additional_info[payer][phone][number]" value="{{ old('additional_info.payer.phone.number') }}" type="number" id="phone" class="form-control" />
                    @error('additional_info.payer.phone.number')
                    <div class="invalid-feedback">
                        Telefone inválido
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                          <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                        </svg>
                                    </span>
                        <input name="payer[email]" value="{{ old('payer.email') }}" type="email" class="form-control" id="email" placeholder="E-mail"  >
                    </div>
                    @error('payer.email')
                    <div class="invalid-feedback">
                        Preencha o e-mail.
                    </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="identificationType" class="form-label">Tipo</label>
                    <select name="payer[identification][type]" class="form-select" id="identificationType"  >
                        <option value="">Escolha o tipo...</option>
                        <option value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                    </select>
                    @error('payer.identification.type')
                    <div class="invalid-feedback">
                        Preencha o tipo.
                    </div>
                    @enderror
                </div>
                <div class="col-md-9">
                    <label for="identificationNumber" class="form-label">CPF/CNPJ</label>
                    <input name="payer[identification][number]" value="{{ old('payer.identification.number') }}" type="number" id="identificationNumber" class="form-control" />
                    @error('payer.identification.number')
                    <div class="invalid-feedback">
                        Preencha com seu CPF/CNPJ
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <h4 class="mb-3">Dados de endereço</h4>
            <div class="row">
                <div class="col-12 mb-4">
                    <label for="zipcode" class="form-label">CEP</label>
                    <input name="payer[address][zip_code]" value="{{ old('payer.address.zip_code') }}" type="text" class="form-control" id="zipcode" />
                    @error('payer.address.zip_code')
                    <div class="invalid-feedback">
                        Preencha seu cep.
                    </div>
                    @enderror
                </div>
                <div class="col-9 mb-4">
                    <label for="street" class="form-label">Endereço</label>
                    <input name="payer[address][street_name]" value="{{ old('payer.address.street_name') }}" type="text" class="form-control" id="street" placeholder=""  >
                    @error('payer.address.street_name')
                    <div class="invalid-feedback">
                        Preencha sua endereço.
                    </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-4">
                    <label for="address_number" class="form-label">Número</label>
                    <input name="payer[address][street_number]" value="{{ old('payer.address.street_number') }}" type="text" class="form-control" id="address_number" placeholder="">
                    @error('payer.address.street_number')
                    <div class="invalid-feedback">
                        Obrigatório.
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="city" class="form-label">Cidade</label>
                    <input name="payer[address][city]" value="{{ old('payer.address.city') }}" type="text" class="form-control" id="city" placeholder="">
                    @error('payer.address.city')
                    <div class="invalid-feedback">
                        Preencha a cidade.
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="state" class="form-label">Estado</label>
                    <select name="payer[address][federal_unit]" class="form-control" id="state">
                        <option value="" >Selecione o Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="EX">Estrangeiro</option>
                    </select>
                    @error('payer.address.federal_unit')
                    <div class="invalid-feedback">
                        Preencha o estado.
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input name="payer[address][neighborhood]" value="{{ old('payer.address.neighborhood') }}" type="text" class="form-control" id="neighborhood" placeholder="">
                    @error('payer.address.neighborhood')
                    <div class="invalid-feedback">
                        Preencha o bairro.
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Carrinho</span>
                <span class="badge bg-primary rounded-pill">2</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Produto 1</h6>
                        <small class="text-muted">Descrição do produto</small>
                    </div>
                    <span class="text-muted">R$ 100,00</span>
                    <input name="additional_info[items][0][id]" type="hidden" value="MLB2907679857">
                    <input name="additional_info[items][0][title]" type="hidden" value="Produto 1">
                    <input name="additional_info[items][0][description]" type="hidden" value="Descrição do produto">
                    <input name="additional_info[items][0][picture_url]" type="hidden" value="">
                    <input name="additional_info[items][0][category_id]" type="hidden" value="eletronicos">
                    <input name="additional_info[items][0][quantity]" type="hidden" value="1">
                    <input name="additional_info[items][0][unit_price]" type="hidden" value="100">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Produto 2</h6>
                        <small class="text-muted">Descrição do produto</small>
                    </div>
                    <span class="text-muted">R$ 100,00</span>
                    <input name="additional_info[items][1][id]" type="hidden" value="MLB2907679858">
                    <input name="additional_info[items][1][title]" type="hidden" value="Produto 2">
                    <input name="additional_info[items][1][description]" type="hidden" value="Descrição do produto">
                    <input name="additional_info[items][1][picture_url]" type="hidden" value="">
                    <input name="additional_info[items][1][category_id]" type="hidden" value="eletronicos">
                    <input name="additional_info[items][1][quantity]" type="hidden" value="1">
                    <input name="additional_info[items][1][unit_price]" type="hidden" value="100">
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <input name="transaction_amount" id="transactionAmount" type="hidden" value="200">
                    <span>Total (R$)</span>
                    <strong>R$200</strong>
                </li>
            </ul>

            <h4 class="mb-3">Pagamento</h4>

            <div class="row mb-4 mx-1">
                <div class="col-md-6 form-check">
                    <input name="payment_method_id" id="boleto" onclick="showSectionCredit()" type="radio" class="form-check-input" value="bolbradesco" checked>
                    <label class="form-check-label w-100" for="boleto">Boleto</label>
                </div>
                <div class="col-md-6 form-check">
                    <input name="payment_method_id" id="credito" onclick="showSectionCredit()" type="radio" class="form-check-input" value=""  >
                    <label class="form-check-label w-100" for="credito">Cartão de crédito</label>
                </div>
            </div>

            <div class="row box-credito">
                <div class="col-md-12 mb-2">
                    <label for="cardHolderName" class="form-label">Titular do cartão</label>
                    <input type="text" class="form-control" id="cardHolderName" placeholder=""  >
                </div>

                <div class="col-md-6 mb-2">
                    <label for="expirationDate" class="form-label">Data de expiração</label>
                    <div id="expirationDate"></div>
                </div>

                <div class="col-md-6 mb-2">
                    <label for="securityCode" class="form-label">CVV</label>
                    <div id="securityCode"> </div>
                </div>

                <div class="col-md-6 mb-2 box-card-number">
                    <label for="cardNumber" class="form-label">Número do cartão</label>
                    <div id="cardNumber"></div>
                </div>

                <div class="col-md-6 mb-2">
                    <label for="installments" class="form-label">Escolha as parcelas</label>
                    <select name="installments" class="form-control" id="installments"></select>
                </div>
                @error('token_card')
                <div class="invalid-feedback">
                    Preencha o token.
                </div>
                @enderror
            </div>

            <hr class="my-4">
            <input name="token_card" type="hidden" id="tokenCard" value="">
            <input name="issuer_id" type="hidden" id="issueId" value="">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Finalizar pagamento</button>
        </div>
    </div>
</form>


