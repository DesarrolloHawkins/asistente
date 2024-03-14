<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Whatsapp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">

    <style>
        body {
          background-color: #3498db;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          text-rendering: optimizeLegibility;
        }

        .container {
          margin: 60px auto;
          background: #fff;
          padding: 0;
          border-radius: 7px;
        }

        .profile-image {
          width: 50px;
          height: 50px;
          border-radius: 40px;
        }

        .settings-tray {
          background: #eee;
          padding: 10px 15px;
          border-radius: 7px;
        }
        .settings-tray .no-gutters {
          padding: 0;
        }
        .settings-tray--right {
          float: right;
        }
        .settings-tray--right i {
          margin-top: 10px;
          font-size: 25px;
          color: grey;
          margin-left: 14px;
          transition: 0.3s;
        }
        .settings-tray--right i:hover {
          color: #74b9ff;
          cursor: pointer;
        }

        .search-box {
          background: #fafafa;
          padding: 10px 13px;
        }
        .search-box .input-wrapper {
          background: #fff;
          border-radius: 40px;
        }
        .search-box .input-wrapper i {
          color: grey;
          margin-left: 7px;
          vertical-align: middle;
        }

        input {
          border: none;
          border-radius: 30px;
          width: 80%;
        }
        input::placeholder {
          color: #e3e3e3;
          font-weight: 300;
          margin-left: 20px;
        }
        input:focus {
          outline: none;
        }

        .friend-drawer {
          padding: 10px 15px;
          display: flex;
          vertical-align: baseline;
          background: #fff;
          transition: 0.3s ease;
        }
        .friend-drawer--grey {
          background: #eee;
        }
        .friend-drawer .text {
          margin-left: 12px;
          width: 70%;
        }
        .friend-drawer .text h6 {
          margin-top: 6px;
          margin-bottom: 0;
        }
        .friend-drawer .text p {
          margin: 0;
        }
        .friend-drawer .time {
          color: grey;
        }
        .friend-drawer--onhover:hover {
          background: #74b9ff;
          cursor: pointer;
        }
        .friend-drawer--onhover:hover p,
        .friend-drawer--onhover:hover h6,
        .friend-drawer--onhover:hover .time {
          color: #fff !important;
        }
        p.fecha_mensaje {
            font-size: 0.8rem;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        hr {
          margin: 5px auto;
          width: 60%;
        }

        .chat-bubble {
          padding: 10px 14px;
          background: #fff;
          margin: 10px 30px;
          border-radius: 9px;
          position: relative;
          animation: fadeIn 1s ease-in;
        }
        .chat-bubble2 {
          padding: 10px 14px;
          background: #d9fdd3;
          margin: 10px 30px;
          border-radius: 9px;
          position: relative;
          animation: fadeIn 1s ease-in;
        }
        .chat-bubble2:after {
          content: "";
          position: absolute;
          top: 50%;
          width: 0;
          height: 0;
          border: 20px solid transparent;
          border-bottom: 0;
          margin-top: -10px;
        }
        .chat-bubble:after {
          content: "";
          position: absolute;
          top: 50%;
          width: 0;
          height: 0;
          border: 20px solid transparent;
          border-bottom: 0;
          margin-top: -10px;
        }
        .chat-bubble--left:after {
          left: 0;
          border-right-color: #fff;
          border-left: 0;
          margin-left: -20px;
        }
        .chat-bubble--right:after {
          right: 0;
          border-left-color: #fff;
          border-right: 0;
          margin-right: -20px;
        }
        .chat-bubble2--right:after {
          right: 0;
          border-left-color: #d9fdd3;
          border-right: 0;
          margin-right: -20px;
        }

        @keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }
        .offset-md-9 .chat-bubble {
          background: #74b9ff;
          color: #fff;
        }

        .chat-box-tray {
          background: #eee;
          display: flex;
          align-items: baseline;
          padding: 10px 15px;
          align-items: center;
          margin-top: 19px;
          bottom: 0;
        }
        .chat-box-tray input {
          margin: 0 10px;
          padding: 6px 2px;
        }
        .chat-box-tray i {
          color: grey;
          font-size: 30px;
          vertical-align: middle;
        }
        .chat-box-tray i:last-of-type {
          margin-left: 25px;
        }
        html, body {
        height: 100%;
        margin: 0;
        }

        body {
        background-color: #3498db;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center
        }

        .container {
        height: 90vh; /* Ajusta el contenedor al 100% de la altura de la ventana */
        max-width: 85vw; /* Asegura que el ancho no se desborde */
        overflow: hidden; /* Evita cualquier desbordamiento del contenedor */
        display: flex; /* Habilita la disposición flexible de los elementos internos */
        flex-direction: column; /* Organiza los elementos internos verticalmente */
        }

        .sidebar {
        overflow-y: scroll; /* Habilita desplazamiento vertical si es necesario */
        height: 82%;
        }

        .col-md-4.border-right {
        height: 100%; /* Asegura que este div use todo el alto disponible */
        }

        .chat-panel {
        flex-grow: 1; /* Permite que este div ocupe el espacio restante */
        overflow-y: scroll;
        height: 85%;
        padding-bottom: 2rem;
        background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');
        }

        .no-gutters {
            overflow: hidden;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row no-gutters" style="height: inherit;">
            <div class="col-md-4 border-right">
                <div class="settings-tray">
                <img class="profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/filip.jpg" alt="Profile img">
                <span class="settings-tray--right">
                    <i class="material-icons">cached</i>
                    <i class="material-icons">message</i>
                    <i class="material-icons">menu</i>
                </span>
                </div>
                <div class="search-box">
                <div class="input-wrapper">
                    <i class="material-icons">search</i>
                    <input placeholder="Search here" type="text">
                </div>
                </div>
                <div class="sidebar">
                    @php
                    $items = $resultado;
                    function cmp($a, $b)
                    {
                        if ($a == $b) {
                            return 0;
                        }
                        return ($a['created_at'] < $b['created_at']) ? 1 : -1;
                    }
                    // dd($resultado);

                    foreach ($items as $key => $result) {
                    // $items = usort($result, "cmp");
                    $result = usort($result, "cmp");

                    }

                    // dd($items);

                    @endphp
                    @foreach ($items as $key => $item)
                    {{-- {{dd($items)}} --}}
                        <div class="friend-drawer friend-drawer--onhover" data-id="{{$key}}">
                            <img class="profile-image" src="https://media.istockphoto.com/id/1337144146/es/vector/vector-de-icono-de-perfil-de-avatar-predeterminado.jpg?s=612x612&w=0&k=20&c=YiNB64vwYQnKqp-bWd5mB_9QARD3tSpIosg-3kuQ_CI=" alt="">
                            <div class="text">
                                <h6>{{$item[0]->nombre_remitente}}</h6>
                                <small>{{$key}}</small>
                                <p class="text-muted">{{ \Illuminate\Support\Str::limit($item[0]->mensaje, 20, '...') }}</p>
                            </div>
                            <span class="time text-muted small">{{$item[0]->created_at}}</span>
                        </div>
                @endforeach
                </div>
            </div>
          <div id="chat-mensajes" class="col-md-8" style="display:none;height: inherit;">

          </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        // Video tutorial/codealong here: https://youtu.be/fCpw5i_2IYU
        var data = @json($resultado);
        var datas = JSON.stringify(data)
        // console.log(data)
        // console.log(datas)

        $( '.friend-drawer--onhover' ).on( 'click',  function() {
            var remitenteId = $(this).attr('data-id'); // Obtén el ID del remitente del atributo data-id.
            var nombreRemitente = data[remitenteId][0]['nombre_remitente'];
            // data.forEach(function(item){
            //     item.remitente == remitenteId ? nombreRemitente = item.nombre_remitente : ''
            // })

            var template = `
            <div class="settings-tray">
                <div class="friend-drawer no-gutters friend-drawer--grey">
                    <img class="profile-image" src="https://media.istockphoto.com/id/1337144146/es/vector/vector-de-icono-de-perfil-de-avatar-predeterminado.jpg?s=612x612&w=0&k=20&c=YiNB64vwYQnKqp-bWd5mB_9QARD3tSpIosg-3kuQ_CI=" alt="">
                    <div class="text">
                        <h6>${nombreRemitente}</h6>
                        <small>${remitenteId}</small>
                        <p style="display:none"class="text-muted">Layin' down the law since like before Christ...</p>
                </div>
                <span class="settings-tray--right">
                  <i class="material-icons">cached</i>
                  <i class="material-icons">message</i>
                  <i class="material-icons">menu</i>
                </span>
              </div>
            </div>
            <div class="chat-panel" id="contenedorChat">`


            var recorrer = data[$(this).attr('data-id')]
            function unicodeToChar(text) {
                return text.replace(/\\u[\dA-F]{4}/gi,
                        function (match) {
                            return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
                        });
            }

            var dataMensaje = [];


            $('#chat-mensajes').empty()
            $('#chat-mensajes').append(template).show()
            // var dataMensaje = [];
            // recorrer.sort(function(a, b){return b['created_at'] - a['created_at']})

            const sortedActivities = recorrer.sort((a, b) => {
              const date1 = new Date(a.created_at)
              const date2 = new Date(b.created_at)

              return date1 - date2;
            })

            // console.log(sortedActivities)


            Object.entries(sortedActivities).forEach(([key, value]) => {
              console.log(value)
              if(value.type == 'image'){
                var templateChat = `
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="chat-bubble chat-bubble--left">
                                <img src="https://thwork.crmhawkins.com/image/${value.mensaje}.jpg" style="width: -webkit-fill-available;">
                            </div>
                        </div>
                    </div>`
              }else {
                if (value.mensaje != null) {
                    var templateChat = `
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="chat-bubble chat-bubble--left">
                                ${value.mensaje}
                                <p class="fecha_mensaje">
                                    <small>
                                    ${formatDate(value.created_at)}
                                </small>
                                </p>
                            </div>
                        </div>
                    </div>`
                }

            }
              if (value.respuesta != null) {
                var templateChatRespuesta = `
                <div class="row no-gutters" style="justify-content: end;">
                    <div class="col-md-6">
                        <div class="chat-bubble2 chat-bubble2--right" >
                                ${unicodeToChar(value.respuesta)}
                            <p class="fecha_mensaje">
                                <small>
                                ${formatDate(value.created_at)}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>`
              }

                dataMensaje.push(templateChat)
                $('#contenedorChat').append(templateChat)
                $('#contenedorChat').append(templateChatRespuesta)
            })

            var templateFinal = '</div></div>'

            $('#contenedorChat').append(templateFinal)

            // console.log(dataMensaje)
            // console.log($(this).attr('data-id'))
            // console.log(data['34622440984'])

            // $( '.chat-bubble' ).hide('slow').show('slow');
            // Una vez que se han agregado los mensajes al contenedor del chat, haz scroll hasta el final.
            var chatPanel = $('#contenedorChat'); // Selecciona el contenedor del chat.
            var scrollHeight = chatPanel.prop('scrollHeight'); // Obtiene la altura total del contenedor, incluyendo el contenido no visible.
            chatPanel.scrollTop(scrollHeight); // Establece la posición del scroll al final.
        });
        function formatDate(dateString) {
            const days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const date = new Date(dateString);
            const dayOfWeek = days[date.getDay()];
            const formattedDate = dayOfWeek + ': ' +
                                ('0' + date.getDate()).slice(-2) + '-' +
                                ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                date.getFullYear() + ' - ' +
                                ('0' + date.getHours()).slice(-2) + ':' +
                                ('0' + date.getMinutes()).slice(-2) + ':' +
                                ('0' + date.getSeconds()).slice(-2);
            return formattedDate;
        }



    </script>
</body>
</html>




