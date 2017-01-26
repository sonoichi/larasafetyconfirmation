<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>安否確認システム | laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #FFF;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @yield('css')
    </head>
    <body>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
      @yield('content')
<script src="https://code.jquery.com/jquery-2.2.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js" integrity="sha256-eEa1kEtgK9ZL6h60VXwDsJ2rxYCwfxi40VZ9E0XwoEA=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      @yield('script')
<!-- セッション 戻るボタンでの制限：いい方法があったら変更する（仮処置） -->
<!--  -->
<script>
    history.pushState(null, null, null);

    window.addEventListener("popstate", function() {
        history.pushState(null, null, null);
    });
</script>
<!-- 他で流用するかもしれない。まとめられる内容になったら以下をまとめる -->
<!--
    .confirm  に対する送信確認
-->
<script>
$(function(){
    $(".confirmCheck").click(function(){
        // カスタムメッセージ版 


        //確認用簡易版: カスタム版作成したので不要
        // if(confirm("送信してもよろしいでしょうか？")){
        //     return true;
        // }else{
        //     return false;
        // }
    });
});
</script>

<!--
    .edit　に対する編集確認
-->
<script>
$(function(){
    $(".edit").click(function(){
        // カスタムメッセージ版    

        // 確認用簡易版: カスタム版作成したので不要
        // if(confirm("登録してもよろしいでしょうか？")){
        //     return true;
        // }else{
        //     return false;
        // }
    });
});
</script>
    </body>
</html>
