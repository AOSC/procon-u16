

casper.test.begin('tests', 1, function (test) {
  casper.start('http://procon.dev/entry.php', function () {
    this.fillSelectors('form[action="api/entry.php"]', {
      'input[name="name"]': '島口知也',
      'input[name="school_name"]': '旭川市東陽中学校',
      'input[name="grade"]': "2",
      'input[name="email"]': 'smagch@gmail.com',
      'input#kyogi': true,
      'input#sakuhin': false,
      'input#jugyo': true,
      'input[name="q_kyogi_macro"]': 'yes',
      'input[name="q_kyogi_exp"]': 'no',
      'textarea[name="comment"]': '特にありません',
      'textarea[name="comment_lecture"]': '',
      'textarea[name="comment_kyogi"]': '',
      'textarea[name="comment_sakuhin"]': '',
      'textarea[name="comment_jugyo"]': '',
      'input[name="confirm"]': true
    }, true);
  }).waitFor(function check() {
    return this.getCurrentUrl() == 'http://procon.dev/api/entry.php';
  }, function then(response) {
    this.test.assertEquals(response.status, 200);
  }, function timeout() {
    if (this.exists('.formErrorContent')) {
      console.error('form validation error');
      console.error(this.fetchText('.formErrorContent'));
      console.error(this.getHTML());
    } else {
      console.error('unexpected timeout');
      console.error(this.getCurrentUrl());
    }
    this.exit();
  }).run(function () {
    test.done();
  });
});
