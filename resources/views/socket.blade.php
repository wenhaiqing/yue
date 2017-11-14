<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->

        <!-- Styles -->
    </head>
    <body id="demo">
       <ul>
           <li v-for="user in users">@{{ user }}</li>
       </ul>
    </body>

    <script src="https://cdn.bootcss.com/socket.io/2.0.2/socket.io.js"></script>
    <script src="https://cdn.bootcss.com/vue/1.0.4/vue.min.js"></script>
    <script>
        var socket = io('127.0.0.1:3000');
        new Vue({
            el: '#demo',
            data:{
                users:[]
            },
            ready:function () {
                console.log(1);
                socket.on('test-channel',function (data) {
                    console.log(data.name);
                    this.users.push(data.name)
                })
            }
        })
    </script>
</html>
