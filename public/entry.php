<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ja"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>U-16旭川プログラミングコンテスト 2013エントリーフォーム</title>
  <meta name="description" content="2013年度U-16旭川プログラミングコンテストエントリーフォーム">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/simplegrid.css">
  <link rel="stylesheet" href="css/formee-structure.css">
  <link rel="stylesheet" href="css/formee-style.css">
  <link rel="stylesheet" href="css/validationEngine.jquery.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/modernizr.js"  type="text/javascript" charset="utf-8"></script>
  <link rel="canonical" href="http://procon-asahikawa.org/entry" />
</head>
<body>
  <!--[if lt IE 7]>
  <section id='oldie-outdated'>
    <div class='inner'>
      <p>
        お使いのブラウザが<strong>かなり古くなっています</strong>。
        安心してネットを利用するために<a href="http://browsehappy.com/">アップグレード</a>するか<a href="http://www.google.com/chromeframe/?redirect=true&prefersystemlevel=true&hl=ja">Google Chrome Frame</a>をお使いください
      </p>
    </div>
  </section>
  <![endif]-->

  <section id='jsnotice'>
    <div class='inner'>
      <p>
        このWebサイトの全ての機能を利用するためにはJavaScriptを有効にする必要があります。
        <a href="http://www.enable-javascript.com/ja/" target="_blank">
          あなたのWebブラウザーでJavaScriptを有効にする方法
        </a>
        を参照してください。
      </p>
    </div>
  </section>

  <section>
    <header>
      <h1>プロコン参加フォーム</h1>
      <p>不具合があればご報告ください</p>
    </header>
  </section>

  <form action='api/entry.php' method='POST' class="form formee">
    <section class='form middle-content clearfix'>
      <label for='name'>名前</label>
      <input name='name' type='text' id='name' class='validate[required] maxSize[100]' />
      <label for='school_name'>学校名</label>
      <input name='school_name' type='text' id='school_name' class='validate[required] maxSize[100]'/>

      <label>学年</label>
      <ul class="formee-list">
        <li>
          <input type='radio' name='grade' id='grade_one' value='1' class='validate[required]'>
          <label for='grade_one'>1</label>
        </li>
        <li>
          <input type='radio' name='grade' id='grade_two' value='2' class='validate[required]'>
          <label for='grade_two'>2</label>
        </li>
        <li>
          <input type='radio' name='grade' id='grade_three' value='3' class='validate[required]'>
          <label for='grade_three'>3</label>
        </li>
      </ul>

      <label>参加部門</label>
      <div class='form-push'>
        <ul class='formee-list'>
          <li>
            <input type='checkbox' value='kyogi' name='category[]' id='kyogi' class='validate[required]' />
            <label for='kyogi'>競技</label>
          </li>
        </ul>

        <div class='form-push'>
          <p>プログラム作成経験について</p>
          <label class='form-push'>エクセルでマクロを組んだことがある?</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' name='q_kyogi_macro' value='yes' id='q_macro_yes'>
              <label for='q_macro_yes'>Yes</label>
            </li>
            <li>
              <input type='radio' name='q_kyogi_macro' value='no' id='q_macro_no'>
              <label for='q_macro_no'>No</label>
            </li>
          </ul>

          <label>プログラムを作ったことがある？</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' name='q_kyogi_exp' value='yes' id='q_exp_yes'>
              <label for='q_exp_yes'>Yes</label>
            </li>
            <li>
              <input type='radio' name='q_kyogi_exp' value='no' id='q_exp_no'>
              <label for='q_exp_no'>No</label>
            </li>
          </ul>

          <label for='comment_kyogi'>プログラム作成経験があれば書いて下さい</label>
          <textarea name='comment_kyogi' id='comment_kyogi'></textarea>
        </div>
      </div>

      <div class='form-push'>
        <ul class='formee-list'>
          <li>
            <input type='checkbox' value='sakuhin' name='category[]' id='sakuhin' class='validate[required]' />
            <label for='sakuhin'>作品</label>
          </li>
        </ul>

        <div class='form-push'>
          <label for='comment_sakuhin'>作成する作品について書いて下さい</label>
          <textarea name='comment_sakuhin' id='comment_sakuhin'></textarea>
        </div>
      </div>

      <div class='form-push'>
        <ul class='formee-list'>
          <input type='checkbox' value='jugyo' name='category[]' id='jugyo' class='validate[required]' />
          <label for='jugyo'>授業(公開競技)</label>
        </ul>
        <div class='form-push'>
          <label for='comment_jugyo'>授業で使用しているマイコンカーの種類などを書いて下さい</label>
          <textarea name='comment_jugyo' id='comment_jugyo'></textarea>
        </div>
      </div>

      <label>競技部門参加者向け講習会</label>
      <ul class='circle'>
        <li>
          <label>7月28日(日) 10:00 ~ 16:00</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' value='1' name='lecture_pref_day_one' />
              <label>第１希望</label>
            </li>
            <li>
              <input type='radio' value='2' name='lecture_pref_day_one' />
              <label>第２希望</label>
            </li>
            <li>
              <input type='radio' value='3' name='lecture_pref_day_one' checked />
              <label>第３希望</label>
            </li>
          </ul>
        </li>

        <li>
          <label>8月3日(日)  10:00 ~ 16:00</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' value='1' name='lecture_pref_day_two' />
              <label>第１希望</label>
            </li>
            <li>
              <input type='radio' value='2' name='lecture_pref_day_two' />
              <label>第２希望</label>
            </li>
            <li>
              <input type='radio' value='3' name='lecture_pref_day_two' checked />
              <label>第３希望</label>
            </li>
          </ul>
        </li>

        <li>
          <label>8月4日(日)  10:00 ~ 16:00</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' value='1' name='lecture_pref_day_three' />
              <label>第１希望</label>
            </li>
            <li>
              <input type='radio' value='2' name='lecture_pref_day_three' />
              <label>第２希望</label>
            </li>
            <li>
              <input type='radio' value='3' name='lecture_pref_day_three' checked />
              <label>第３希望</label>
            </li>
          </ul>
        </li>

        <li>
          <label>8月10日(日) 10:00 ~ 16:00</label>
          <ul class='formee-list'>
            <li>
              <input type='radio' value='1' name='lecture_pref_day_four' />
              <label>第１希望</label>
            </li>
            <li>
              <input type='radio' value='2' name='lecture_pref_day_four' />
              <label>第２希望</label>
            </li>
            <li>
              <input type='radio' value='3' name='lecture_pref_day_four' checked />
              <label>第３希望</label>
            </li>
          </ul>
        </li>
      </ul>

      <label for='comment_lecture'>講習会について希望があれば書いてください</label>
      <textarea name='comment_lecture' id='comment_lecture'></textarea>

      <label for='comment'>質問等があれば書いてください</label>
      <textarea name='comment' id='comment'></textarea>

      <ul class='formee-list'>
        <li>
          <input type='checkbox' class='validate[required]' id='confirm' name='confirm'>
          <label for='confirm'>以上の内容で登録します</label>
        </li>
      </ul>

      <input type="submit" title="送信" value="送信" class='right' />
    </section>
  </form>

  <footer>
    <aside>
      <a href="http://www.w3.org/html/logo/">
        <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png"
          alt="HTML5 Powered with CSS3 / Styling, and Semantics"
          width="165" height="64"
          title="HTML5 Powered with CSS3 / Styling, and Semantics" />
      </a>
    </aside>
    <ul class='grid grid-pad'>
      <li class='col-1-1'>
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.1/jp/deed.en_US">
          <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.1/jp/">
            <img alt="クリエイティブ・コモンズ・ライセンス" style="border-width:0"
              src="http://i.creativecommons.org/l/by-nc-sa/2.1/jp/88x31.png" />
          </a>
          <br />
          <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">procon-u16</span> by
          <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">AOSC</span>
          is licensed under a
          <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.1/jp/">
            Creative Commons 表示 - 非営利 - 継承 2.1 日本 License</a>.
        </a>
      </li>
    </div>
  </footer>

  <script src="js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/entry.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
