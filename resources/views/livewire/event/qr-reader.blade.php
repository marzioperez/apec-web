<div>
    <div id="reader" width="600px;"></div>

    @if($process_user)
        <div id="process-user"
         style="padding: 20px; background: #FFF; text-align: center; margin-top: 20px; border-radius: 10px;">
            <img src="{{asset('img/success-animation.gif')}}" style="width: 100px; display: inline-block; margin-bottom: 10px;" />
            <p style="color: #000; margin-bottom: 10px;">Se ha confirmado la participación de: <b>{{$process_user['name']}}</b></p>
            <a href="{{config('app.url')}}/admin/qr-reader" style="padding: 8px 10px; border-radius: 5px; color: #FFF; background: rgba(var(--primary-400),var(--tw-text-opacity));" >Escanear otro</a>
        </div>
    @endif
</div>
<script src="{{asset('js/html5-qrcode.min.js')}}" type="text/javascript"></script>
<script>
    const scanner = new Html5QrcodeScanner('reader', {
        qrbox: {
            width: 250,
            height: 250
        },
        fps: 20,
    });
    scanner.render(success, error);

    function success(result) {
        Livewire.dispatch('process-qr', {id:result});
        scanner.clear();
    }

    function error(error) {
        console.log(error);
    }

    // document.addEventListener('livewire:init', () => {
    //     Livewire.on('process-user', (data) => {
    //         if(data.length > 0) {
    //             let process_user = document.getElementById('process-user');
    //             let process_user_name = document.getElementById('user-name');
    //             process_user_name.innerHTML = data[0]['name'];
    //             process_user.classList.remove("hidden");
    //         }
    //     });
    // });
</script>
