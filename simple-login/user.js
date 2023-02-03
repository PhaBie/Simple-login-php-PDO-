var product = [{
    id: 1,
    img: 'https://www.thaicar-accessories.com/wp-content/uploads/2020/10/05cItXL96l4LE9n02WfDR0h-5..1582751026.png',
    name: 'Netflix',
    price: 70 ,
    description: 'Nike Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, labore dolorum optio ad consequatur cupiditate!',
    type: 'Netflix'
}, {
    id: 2,
    img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvKm_geY_vIBZEpWEszMQQWC0_cUI7f35Dlx5WhNOIQNjVyDhkt3hrT5ctQeQhwlU7QZk&usqp=CAU',
    name: 'Youtube Premium',
    price: 40,
    description: 'Adidas shoe Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, labore dolorum optio ad consequatur cupiditate!',
    type: 'YoutubePremium'
}, {
    id: 3,
    img: 'https://play-lh.googleusercontent.com/0w46WqA_Ofs5bL-mT-dm40PGfxRfRYhZ2R1OC1FiDbK502mhxAj5-r9_nXNs0SFakRA',
    name: 'Disney +',
    price: 15 ,
    description: 'Adidas shoe Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, labore dolorum optio ad consequatur cupiditate!',
    type: 'Disney + "+"'
}, {
    id: 4,
    img: 'https://www.thumbsup.in.th/wp-content/uploads/2021/02/spotify-2021.jpg',
    name: 'Spotify Premium (ใช้ได้นานตามดวง)',
    price: 60,
    description: 'Adidas shoe Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, labore dolorum optio ad consequatur cupiditate!',
    type: 'SpotifyPremium'
},{
    id: 5,
    img: 'https://seeklogo.com/images/V/valorant-logo-FAB2CA0E55-seeklogo.com.png',
    name: 'Valorant ID (ลงแรงค์ได้)',
    price: 40,
    description: 'Adidas shoe Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, labore dolorum optio ad consequatur cupiditate!',
    type: 'ValorantID'
}];

// [{},{},{}] // length = 3

$(document).ready(() => {
    var html = '';
    for (let i = 0; i < product.length; i++) {
        html += `<div onclick="openproductdetail(${i})" class="product-item ${product[i].type}">
        <img class="product-img" src="${product[i].img}" alt="">
        <p style="font-size: 1.2vw;">${product[i].name}</p>
        <p style="font-size: 1.2vw;">${ numberWithCommas(product[i].price)} THB</p>
    </div>`;
    }
    $("#productlist").html(html);

})


function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function searchsomething(elem) {
    var value = $('#'+elem.id).val()

    var html = '';
    for (let i = 0; i < product.length; i++) {
        if( product[i].name.includes(value) ) {
            html += `<div onclick="openproductdetail(${i})" class="product-item ${product[i].type}">
        <img class="product-img" src="${product[i].img}" alt="">
        <p style="font-size: 1.2vw;">${product[i].name}</p>
        <p style="font-size: 1.2vw;">${ numberWithCommas(product[i].price)} THB</p>
    </div>`;
    }

}

if(html == ''){
    $("#productlist").html(`<p>ไม่พบสินค้า</p>`);
} else {
    $("#productlist").html(html);
    }

}


function searchproduct(Menu) {
    console.log(Menu)
    $(".product-item").css('display', 'none')
    if(Menu == 'all') {
        $(".product-item").css('display' , 'block')
    }
    else {
        $("."+Menu).css('display', 'block')
    }
}

var productdetail = 0;
function openproductdetail(indexproduct){
    productdetail = indexproduct;
    console.log(productdetail)
    $("#modalDesc").css('display', 'flex')
    $("#mdd-img").attr('src', product[indexproduct].img);
    $("#mdd-name").text(product[indexproduct].name)
    $("#mdd-price").text( numberWithCommas(product[indexproduct].price) + ' THB')
    $("#mdd-desc").text(product[indexproduct].description)
}

function closeModal() {
    $(".modal").css('display','none')
}


function closemodal() {
    $(".modal").css('display', 'none')
}

var cart = [];
function addtocart() {
    var pass = true;

    for (let i = 0; i < cart.length; i++) {
        if(productdetail == cart[i].index ) {
            console.log('เพิ่มสินค้าได้ที่ตะกร้า')
            cart[i].count++;
            pass = false;
        }
        
    }
    if (pass) {
        var obj = {
            index: productdetail,
            id: product[productdetail].id,
            name: product[productdetail].name,
            price: product[productdetail].price,
            img: product[productdetail].img,
            count: 1
        };
        //console.log(obj)
        cart.push(obj)
    }
    console.log(cart)

    Swal.fire({
        title: 'คุณต้องการซื้อ ' + product[productdetail].name + 'ในราคา ' + product[productdetail].price + 'หรือไม่',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'ยืนยัน',
        denyButtonText: `ยกเลิก`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('สั่งซื้อสำเร็จ!', 'ข้อมูลสินค้าท่านสั่งซื้อ จะส่งไปที่กล่องจดหมาย', 'success')
        } else if (result.isDenied) {
          Swal.fire('ยกเลิกการสั่งซื้อสำเร็จ', '', 'error')
        }
      })
}

function opencart() {
    $("#modalcart").css('display' , 'flex')
    rendercart()
}

