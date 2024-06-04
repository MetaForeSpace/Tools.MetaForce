@extends('layouts.default')
@section('head')
    <title>Web3 data</title>
@stop
@section('content')
    <section>
        <div class="container-sm pt-5">
            <h2 class="text-center">Получение данных<br/>userId, dai, forcecoin, energy по адресу кошелька</h2>
            <div class="row mt-3">
                <div class="col">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <input class="form-control" id="account" placeholder="Введите адрес кошелька 0x" />
                        <div class="mt-3" id="result"></div>
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto mt-3">
                        <button type="button" class="btn btn-primary" id="send">Запрос</button>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop

@push('scripts')
    <script src="//cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>
    <script>
        const input = document.getElementById('account');
        const button = document.getElementById('send');
        const result = document.getElementById('result');

        button.addEventListener('click', function() {

            result.innerHTML = 'Выполнение запроса...'

            const web3 = new window.Web3Utils

            web3.getBalance(input.value).then((data) => {

                const contentData = document.createElement('div');
                contentData.innerHTML = JSON.stringify(data, null, 2).replace(/\n/g, "<br>").replace(/[ ]/g, "&nbsp;");

                let content = new window.Content;
                result.innerHTML = content.buildAlert(contentData).outerHTML;

                let myAlert = document.getElementById('myAlert');
                myAlert.addEventListener('closed.bs.alert', function () {
                    input.value = ''
                });

            }).catch(function(error) {
                result.innerHTML = '';
                alert(error.message);
            });

        }, false);
    </script>
@endpush
