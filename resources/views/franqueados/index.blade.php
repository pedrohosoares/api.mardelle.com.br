<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Str::ucfirst($afiliate->name) }} - Mardelle Lingerie</title>
</head>

<body>
    <style>
        html,
        body,
        iframe {
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100%;
        }
    </style>
    <iframe src="https://mardelle.com.br"></iframe>
    <script>

        const iframeDOM = {
            site: '',
            parametersLinks: "parceiro={{ $afiliate->id_external }}",
            iframe() {
                return document.querySelector('iframe');
            },

            putUrlInLinks() {
                const allLinks = this.site.querySelectorAll('a');
                allLinks.forEach((link) => {
                    console.log(link.href);
                    let newLink = link.href;
                    if (link.href.indexOf(iframeDOM.parametersLinks) == -1) {
                        if (link.href.indexOf('?') > -1) {
                            newLink = link.href + "&" + iframeDOM.parametersLinks;
                        } else {
                            newLink = link.href + "?" + iframeDOM.parametersLinks;
                        }
                    }
                    link.href = newLink;
                });
            },
            render() {
                this.putUrlInLinks();
            },
            accessIframe() {
                this.iframe().addEventListener("load", ev => {
                    iframeDOM.site = iframeDOM.iframe().contentWindow.document.body;
                    iframeDOM.render();
                })
            },
            init() {
                this.accessIframe();
            }
        };
        iframeDOM.init();
    </script>
</body>

</html>
