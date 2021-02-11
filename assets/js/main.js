hljs.configure({
    tabReplace: '    ', // 4 spaces
});


hljs.initHighlightingOnLoad();


document.addEventListener('click', function (e) {
    e = e || window.event;
    let classList = new Array(...e.target.classList)
    if (classList.includes('copy-button')) {
        let code = e.target.nextSibling.childNodes[0];
        let range = document.createRange();
        range.selectNode(code);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
    }
}, false);

document.querySelectorAll('.lang').forEach((lang) => {
    let classes = ['hljs', 'hljs-built_in'];
    lang.classList.add(...classes)
})