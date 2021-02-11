// javascript:var s=document.createElement("script");s.src="https://popn.nulldori.tech/48.js";s.type="text/javascript";document.getElementsByTagName("body")[0].appendChild(s);

let TARGET_LEVEL = 49
let BASE_URL = "https://p.eagate.573.jp/game/popn/riddles/playdata/mu_lv.html"

let medalData = {}

function initDocument (html) {
    let doc = document.implementation.createHTMLDocument()
    doc.documentElement.innerHTML = html

    return doc
}

async function getPage(page) {
    let param = new URLSearchParams()

    param.append("page", page)
    param.append("level", TARGET_LEVEL)

    return await fetch(`${BASE_URL}?${param.toString()}`)
        .then(res => res.arrayBuffer())
        .then(buffer => {
            return new TextDecoder("shift-jis").decode(buffer)
        })
        .then(text => initDocument(text))
}

async function crawlPage(page) {
    let virtualDocument = await getPage(page)
    let table = virtualDocument.querySelector('ul.mu_list_table')

    let rows = Array.from(table.children).slice(1)

    for(let row of rows) {
        let title = row.querySelector('a').textContent;
        let medal_imgsrc = row.querySelectorAll("div.col_ex_lv img")[0].getAttribute("src").split('/');
        let rank_imgsrc = row.querySelectorAll("div.col_ex_lv img")[1].getAttribute("src").split('/');
        let medal = medal_imgsrc[medal_imgsrc.length - 1];
        let rank = rank_imgsrc[rank_imgsrc.length - 1];
        let score = row.querySelector("div.col_ex_lv").textContent;

        medalData[title] = {medal, rank, score};
    }
}

function sendData() {
    let form = document.createElement('form')

    let input = document.createElement('input')
    input.setAttribute('type', 'hidden')
    input.setAttribute('value', encodeURIComponent(JSON.stringify(medalData)))
    input.setAttribute('name', 'data')

    form.setAttribute('method', 'post')
    form.setAttribute('action', `https://popn.nulldori.tech/${TARGET_LEVEL}.php`)

    form.appendChild(input)
    document.body.appendChild(form)
    form.submit()
}

async function init() {
    let document = await getPage(0)
    let table = document.querySelector('ul.mu_list_table')
    let totalPage = table.nextElementSibling.children.length - 2

    for (let p = 0; p < totalPage; p++) {
        await crawlPage(p)
    }

    sendData()
}

init()