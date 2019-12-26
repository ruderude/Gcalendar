<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gcalendar</title>
  <link rel="stylesheet" href="./style.css" type="text/css">
</head>
<body>
<h1 class="">Gcalendar</h1>

<a class="button" href="login.php">Google認証</a>

</form>
<script>
  // var array = ['Bob', 'Tom', 'Jay', 'Tom'];
  // console.log(array.concat(['Dan']));
  // console.log(array);

  // try {
  //   throw new Error('例外発生！');
  // } catch(e) {
  //   console.log(e.message);
  //   console.log(e.name);
  //   console.log(e.stack);
  //   console.log(e.toString());
  // }

  function myFunction1() {
    throw new Error('例外発生！');
  }

  function myFunction2() {
    myFunction1();
  }

  function myFunction3() {
    try {
      myFunction2();
    } catch(e) {
      console.log(e.stack);
    }
  }

  myFunction3();
</script>
</body>
</html>
