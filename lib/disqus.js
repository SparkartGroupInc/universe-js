function loadComments (shortname, universejs) {

  var placeholder = document.getElementById('disqus_thread');
  if (!placeholder) return;

  var identifier = placeholder.getAttribute('data-disqus-identifier');
  if (!identifier) throw new Error('Disqus placeholder must specify a thread ID with a data-disqus-identifier attribute');

  var title = placeholder.getAttribute('data-disqus-title') || document.title;
  var host = placeholder.getAttribute('data-disqus-domain') || window.location.origin;

  universejs.get('/disqus', function (error, data) {
    if (error) throw new Error('Could not get Disqus SSO data from Universe');

    window.disqus_shortname = shortname;
    window.disqus_url = host + window.location.pathname;
    window.disqus_identifier = identifier;

    window.disqus_config = function () {
      this.page.remote_auth_s3 = data.remote_auth_s3;
      this.page.api_key = data.api_key;
    };

    var disqus = document.createElement('script');
    disqus.type = 'text/javascript';
    disqus.async = true;
    disqus.src = '//' + disqus_shortname + '.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(disqus);
  });

}

module.exports = loadComments;
