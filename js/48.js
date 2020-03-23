// javascript:var s=document.createElement("script");s.src="https://popn.nulldori.tk/48.js";s.type="text/javascript";document.getElementsByTagName("body")[0].appendChild(s);

var medalData = {};

function getPage (currentPage, lastPage)
{
    if(currentPage == lastPage){
        var form = document.createElement('form');
        var input = document.createElement('input')
        input.setAttribute('type', 'hidden')
        input.setAttribute('value', encodeURIComponent(JSON.stringify(medalData)));
        input.setAttribute('name', 'data')

        form.setAttribute('method', 'post');
        form.setAttribute('action', "https://popn.nulldori.tk/48.php");

        form.appendChild(input)
        document.body.appendChild(form);
        form.submit();


        return ;
    }
    
    $.get("https://p.eagate.573.jp/game/popn/peace/p/playdata/mu_lv.html?page=" + currentPage + "&level=48").then(data => {
        $(data, virtualDocument).find("ul.mu_list_table li").each(function(){
            if($(this).find("div.th_music_lv").length == 0){
                var title = $(this).find("a")[0].textContent
                var imgsrc = $(this).find("div.col_ex_lv img")[0].getAttribute("src").split('/')
                var medal = imgsrc[imgsrc.length - 1]
                medalData[title] = medal;
            }
        });


        getPage(currentPage + 1, lastPage)
    });
}

var script = document.createElement('script');
var virtualDocument = document.implementation.createHTMLDocument('virtual');

script.src = '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].append(script);

var checkReady = function(callback) {
    if (window.jQuery){
        console.log("jQuery Ready!");
        callback(jQuery);
    }
    else{
        window.setTimeout(function() { checkReady(callback); }, 20);
    }
}

checkReady(function($) {
    $(function() {
        $.get("https://p.eagate.573.jp/game/popn/peace/p/playdata/mu_lv.html?page=0&level=48").then(data => {
            var totalPage = $(data, virtualDocument).find("ul.mu_list_table")[0].lastElementChild.children.length - 2;
            getPage(0, totalPage);
        });
    });
});