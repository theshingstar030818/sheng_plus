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

    const parentEl02 = document.getElementById('products_view_result');
    console.log("addEventListener:", parentEl02);
    if (parentEl02) {
        console.log("calling getProductList():");

        getProductList(0);
    }
    
    const productDetailEl = document.getElementsByClassName('product-detail')[0];
    if (productDetailEl) {
        // Show the first image by default
        showImage(0);
        openTab(null, 'Tab1', 'product_content_tab_one');
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
function goToPreviousPage() {
    window.history.back();
}

// ----------------------------------------------------------------
// 4 tabs for product content
function openTab(evt, tabName, tabContentId) {
    // Declare all variables
    var i, tabcontent, tablinks;
    console.log("openTab() called");
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    if (evt == null) {
        console.log("openTab() called #1");
        document.getElementById("Tab1").classList.add("active");
    }
    else {
        console.log("openTab() called #2");
        evt.currentTarget.classList.add("active");
    }
    console.log("openTab() called, tabContentId: ", tabContentId);

    if (document.getElementById(tabContentId)) {
        console.log("openTab() called #3");
        let tab_content = document.getElementById(tabContentId).innerHTML;
        console.log('tab_content', tab_content);
        console.log('convertContentToHtml(tab_content)', convertContentToHtml(tab_content));
        if (document.getElementById(tabContentId + "_html")) {
            document.getElementById(tabContentId + "_html").innerHTML = convertContentToHtml(tab_content);
        }    
    }
}
  

// -----------------------------------------------------------------

// --------------------- images on product ---------------------------
function showImage(index) {
    var images = document.getElementsByClassName('image');
    var circles = document.getElementsByClassName('circle');

    for (var i = 0; i < images.length; i++) {
        images[i].style.display = 'none';
        circles[i].classList.remove('active');
    }

    images[index].style.display = 'block';
    circles[index].classList.add('active');
}

// ---------------- convertTextToTable --------------------------

// Function to convert text to HTML table
// | colspan=2 : Column 1 Column 2 | Column 3 |
// | sub column1| sub column 2 | Column 3 |
// | -------- | -------- | -------- |
// | Text     | Text     | Text     |

// Function to convert text to HTML table
function convertStringToTable(text) {
    var lines = text.trim().split('\n');
    var html = '<table border="1">';

    var isHeader = true; // Flag to indicate if we are still in the header section

    lines.forEach(function(line) {
        var cells = line.split('|').map(function(cell) {
            return cell.trim();
        }).filter(function(cell) {
            return cell !== '';
        });

        if (cells[0] === '--------') {
            // Separator line, switch to body rows
            isHeader = false;
        } else {
            html += '<tr>';
            cells.forEach(function(cell) {
                var colspan = 1;
                var rowspan = 1;
                if (cell.startsWith('colspan=')) {
                    var parts = cell.split(':');
                    colspan = parseInt(parts[0].split('=')[1].trim(), 10);
                    cell = parts[1].trim();
                }
                if (cell.includes('rowspan=')) {
                    var parts = cell.split(':');
                    rowspan = parseInt(parts[0].split('=')[1].trim(), 10);
                    cell = parts[1].trim();
                }
                if (isHeader) {
                    html += '<th' + (colspan > 1 ? ' colspan="' + colspan + '"' : '') + (rowspan > 1 ? ' rowspan="' + rowspan + '"' : '') + '>' + cell + '</th>';
                } else {
                    html += '<td' + (colspan > 1 ? ' colspan="' + colspan + '"' : '') + (rowspan > 1 ? ' rowspan="' + rowspan + '"' : '') + '>' + cell + '</td>';
                }
            });
            html += '</tr>';
        }
    });

    html += '</table>';
    return html;
}

// Given string
// var inputString = `砂布輪主要由砂布，樹脂結合劑，玻璃纖維盤，組成的研磨工具。中心有凸起可為砂布輪結構在斜角研磨時補強，讓使用者在斜角研磨安心使用。砂布輪結構具有彈性，與工件接觸時，可提供廣泛研磨面積。砂布輪可安裝在直角砂輪機，適合對廣泛材料進行輕研磨、拋光。
// 特性:
// - 金屬表面、弧度等研磨研磨時富銳利柔軟彈性及低消耗性，作業範圍廣操作容易
// - 一般金屬，鐵材類，木材及非鐵類金屬，金屬焊道研磨及一般表面研磨處理`;

// Function to convert the string to HTML
function convertStringToHtml(input) {
    var lines = input.split('\n');
    var html = '';

    for (var i = 0; i < lines.length; i++) {
        var line = lines[i].trim();

        if (line.startsWith('-')) {
            html += '<div class="marked-line-type-02">' + line.substring(2).trim() + '</div>';
        } else if (i > 0 && lines[i - 1].trim().endsWith(':')) {
            html += '<div class="marked-line-type-01">' + line + '</div>';
        } else {
            html += '<div>' + line + '</div>';
        }
    }

    return html;
}

// function convertContentToHtml(input) {
//     var rtn = "";
//     if(multiLineString.includes("| -------- |")) {
//         rtn = convertStringToTable(input);
//     } else {

//     }
// }

function convertContentToHtml(input) {
    if (!input) {
        return '';
    }
    const lines = input.split('\n');
    let html = '';
    let inTable = false;
    let tableLines = "";

    for (let i = 0; i < lines.length; i++) {
        const line = lines[i].trim();
        if (line.startsWith('|')) {
            tableLines += "\n" + line;
            // if (!inTable) {
            //     html += '<table border="1">';
            //     inTable = true;
            // }
            // if (line.includes('colspan')) {
            //     html += '<tr><th colspan="' + line.match(/colspan=(\d+)/)[1] + '">' + line.split(':')[1].trim().replace(/ \|/g, '</th><th>') + '</th></tr>';
            // } else if (line.includes('--------')) {
            //     // Skip separator line
            // } else {
            //     html += '<tr><td>' + line.split('|').slice(1, -1).join('</td><td>') + '</td></tr>';
            // }
        } else {
            if (tableLines.length > 0) {
                html += convertStringToTable(tableLines);
                tableLines = "";
            }
            if (inTable) {
                html += '</table>';
                inTable = false;
            }
            if (line.startsWith('- ')) {
                html += '<div class="marked-line-type-02">' + line.substring(2) + '</div>';
            } else if (i > 0 && lines[i - 1].trim().endsWith(':')) {
                html += '<div class="marked-line-type-01">' + line + '</div>';
            } else {
                html += '<div>' + line + '</div>';
            }
        }
    }

    if (inTable) {
        html += '</table>';
    }

    console.log("result of convertContentToHtml: ", html);
    return html;
}
// ------------------------------------------------------