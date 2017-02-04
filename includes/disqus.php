<div id="disqus_thread"></div>
<script>

    var QueryString = function () {
        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = decodeURIComponent(pair[1]);
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
                query_string[pair[0]] = arr;
            } else {
                query_string[pair[0]].push(decodeURIComponent(pair[1]));
            }
        }
        return query_string;
    }();

    var url = QueryString.url;
    var identifier = QueryString.identifier;
    var disqus_name = QueryString.disqus_name;
    var disqus_title = QueryString.disqus_title;

    var disqus_config = function () {
        this.page.url = url;
        this.page.title = disqus_title;
        this.page.identifier = identifier || url;
    };

    (function () {
        var d = document, s = d.createElement('script');
        s.src = disqus_name;
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();

    (function () {
        function checkSizeChange() {
            var viewportHeight = window.innerHeight;
            var contentHeight = document.getElementById('disqus_thread').clientHeight;
            if (viewportHeight !== contentHeight && contentHeight > 100) {
                window.parent.postMessage({
                    sentinel: 'amp',
                    type: 'embed-size',
                    height: contentHeight
                }, '*')
            }
        }

        var mutationObserverAvailable = typeof window.MutationObserver === 'function';

        function bindObserver() {
            var foundframe = false,
                frame, framename,
                frames = document.getElementsByTagName('iframe');

            for (var i=0; i < frames.length; ++i) {
                frame = frames[i];
                framename = frame.getAttribute("name");
                if ( framename && /dsq/.test(framename) ) {
                    // check the size now since the frame is now available
                    checkSizeChange();

                    var resizeObserver = new MutationObserver(checkSizeChange);
                    resizeObserver.observe(frame, {
                        attributes: true,
                        attributeFilter: ['style']
                    });
                    foundframe = true;
                    break;
                }
            }

            // if the frame is not available yet try again later
            if (foundframe === false) {
                setTimeout(bindObserver, 200);
                return;
            }
        }

        // use mutation observers to quickly change the size of the iframe
        if (mutationObserverAvailable) {
            bindObserver();
        }

        // also check periodically for the size of the frame
        setInterval(checkSizeChange, mutationObserverAvailable ? 5000 : 500);
    })();
</script>