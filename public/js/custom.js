function openMenu() {
    document.getElementById("popupMenu").style.display = "block";
}

function closeMenu() {
    document.getElementById("popupMenu").style.display = "none";
}

document.addEventListener('DOMContentLoaded', function() {
    const parentEl = document.getElementsByClassName('article-list')[0];
    if (parentEl) {
        getArticleList();
    }

    const parentEl02 = document.getElementsById('products_view_result');
    if (parentEl02) {
        getProductList(0);
    }
    
    // var dropdownItems = document.querySelectorAll('.dropdown-item');

    // dropdownItems.forEach(function(item) {
    //     item.addEventListener('click', function(e) {
    //         e.preventDefault();
    //         var selectedLocale = this.getAttribute('data-locale');
    //         // Assuming you have a route named 'language.switch' that takes the locale as a parameter
    //         // alert(selectedLocale);
    //         // var url = "{{ route('language.switch', '') }}/" + selectedLocale;
    //         // // var url = "{{ route('language.switch', '" + selectedLocale + "') }}/";// + selectedLocale;
    //         // alert(url);
    //         var url = "/language/" + selectedLocale;
    //         window.location.href = url;
    //     });
    // });
});


// -----------------------------------------------------------------
// article list page 
// .article-list
const parentEl = document.getElementsByClassName('article-list')[0];
if (parentEl) {
    const radioButtons = document.querySelectorAll('input[type="radio"]');

    radioButtons.forEach(radioButton => {
      radioButton.addEventListener('click', () => {
        // Uncheck all other radio buttons
        radioButtons.forEach(rb => {
          if (rb !== radioButton) {
            rb.checked = false;
          }
        });
      });
    });    
}

// document.getElementById('ajaxButton').addEventListener('click', function() {
function getArticleList() {
    console.log("getArticleList() called !");
    var product_cate = 0;
    const parentEl = document.getElementsByClassName('article-list')[0];
    if (!parentEl) {
        return;
    }

    const radioButtons = document.querySelectorAll('input[type="radio"]');
    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            product_cate = radioButtons[i].getAttribute('data-id');
        }
    }
    console.log("product_cate: ", product_cate);

    var article_cates = [];
    const chkButtons = document.getElementsByClassName('chk-article_cat');
    for (var i = 0; i < chkButtons.length; i++) {
        if (chkButtons[i].checked) {
            article_cates.push(chkButtons[i].getAttribute('data-id'));
        }
    }

    var search_letters = document.getElementById('search_letters').ariaValueMax;

    fetch('/get-articles', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_cate: product_cate,
            article_cates: article_cates,
            search_letters: search_letters,
        })
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('articles_result_section').innerHTML = html;
    })
    .catch(error => console.error('Error:', error));
}


function getProductList(event) {
    console.log("getProductList() called, event", event);
    if (event == 0) {

    } else {
        var targetElement = event.target;
        const els = document.getElementsByClassName('sub-cate-item');
        if (els.length < 1) {
            return;
        }
    
        for (var i = 0; i < els.length; i++) {
            els[i].className = "sub-cate-item";
        } 
        targetElement.className = "sub-cate-item selected";    
    }
    var targetElement = event.target;

    console.log("getProductList() called !");
    var subcateId = 0;
    const els = document.getElementsByClassName('sub-cate-item');
    if (els.length < 1) {
        return;
    }

    for (var i = 0; i < els.length; i++) {
        var className = els[i].className;

        if (className.includes('selected')) {
            subcateId = els[i].getAttribute('data-id');
        }
    } 
    console.log('subcateId:', subcateId);
    fetch('/get-products/' + subcateId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
        })
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('products_view_result').innerHTML = html;
    })
    .catch(error => console.error('Error:', error));
}


function goToURL(url) {
    window.location.href = url;
}
// -----------------------------------------------------------------
