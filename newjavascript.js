/*
 @Deve trocar https://inbound.citywatch.com.br pela URL do seu MAUTIC
 @EMAIL_DO_LEAD deve receber o email do seu lead
 @NOME_DO_LEAD deve receber o nome do lead
 */


(function(w, d, t, u, n, a, m) {
    w['MauticTrackingObject'] = n;
    w[n] = w[n] || function() {
        (w[n].q = w[n].q || []).push(arguments)
    }, a = d.createElement(t),
            m = d.getElementsByTagName(t)[0];
    a.async = 1;
    a.src = u;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', 'https://inbound.citywatch.com.br/mtc.js', 'mt');
mt('send', 'pageview', {email: EMAIL_DO_LEAD, firstname: NOME_DO_LEAD}, {onload: function() {
        alert("Tracking request is loaded");
    }});