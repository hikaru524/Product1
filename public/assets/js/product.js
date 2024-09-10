//page再生成
function createPagintion(pagedata, page){
   var next_page_url = pagedata.products.next_page_url;
   var prev_page_url = pagedata.products.prev_page_url;
   var last_page = pagedata.products.last_page;
   var url = pagedata.products.first_page_url;
   if(page == null){
      page = 1;
      console.log(page);
   }
   $('.pagination').empty();
   //Prev 制御
   if(prev_page_url == null){
      $(".pagination").append("<li class='page-item disabled'  aria-disabled='true' aria-label='@lang('pagination.previous')'><span class='page-link' aria-hidden='true'>&lsaquo;</span></li>");
   }else{
      $(".pagination").append("<li  class='page-item'><a class='page-link' href='/product/public/search?page='"+(page-1)+"  rel='prev' aria-label='@lang('pagination.previous')'>‹</a></li>");
   }
   //ページリンク
   for(var i=0;i<last_page;i++){
      var link_page = i+1;
      //activeにするかどうか
      if(page==link_page){
         $(".pagination").append("<li class='page-item active' aria-current='page'><span class='page-link'>"+link_page+"</span></li>");               
      }else{
         $(".pagination").append("<li class='page-item'><a class='page-link' href='/product/public/search?page="+link_page+"'>"+link_page+"</a></li>");
      }   
   }
   //Next制御
   if(next_page_url == null){
      $(".pagination").append("<li class='page-item disabled'><span class='page-link' aria-hidden='true'>›</span></li>");
   }else{
      $(".pagination").append("<li class='page-item'><a class='page-link' href='/product/public/search?page="+(page+1)+"' rel='next' aria-label='@lang('pagination.next')'>›</a></li>");
   }
};

//ページ切り替え
$(document).on('click', '.page-link', function(event){
   event.preventDefault();
   var url = $(this).attr('href');
   var page = url.split("=");
   page = page[1];

   $.getJSON('/product/public/search?page=' + page ,null,function(data){
      //グローバルパラメータ取得
      var pagedata = data;
      var data = data.products.data;
      var $result = $('#addlist');
      $result.empty();
      $('.pagination').empty();
      createPagintion(pagedata, page);  
      //テーブルを描画
      $.each(data, function(data, value) {
         var id = value.id;
         var name = value.product_name;
         var img = "http://localhost:8888/product/public" + value.img_path;
         var price = value.price;
         var stock = value.stock;
         var company_name = value.company_name;
         //更新データ表示
         html = `
         <tr id="${id}">
         <td>${id}</td>
         <td><img src=${img} class="img_list"></td>
         <td>${name}</td>
         <td>¥${price}</td>
         <td>${stock}</td>
         <td>${company_name}</td>

         <td class="btn-show-del">
         <a href="{{ route('product.show', ['id'=>$value->id] ) }}" class="btn btn-info">詳細</a>
         <form action="{{ route('product.delete', ['id'=>$value->id]) }}" method="POST">
         <button type="submit" class="btn btn-danger btn-del" value="${id}">削除</button>
         </form>
         </td>
         </tr>
         `
         $result.append(html);
      }) 
   }) 
});

//検索
$(function() {
   $('#btn-search').click(function(event) {
      event.preventDefault();
      //検索値取得
      var keyword = $('#keyword').val();
      var company_id = $('#company_id').val();
      var price_min = $('#price_min').val();
      var price_max = $('#price_max').val();
      var stock_min = $('#stock_min').val();
      var stock_max = $('#stock_max').val();      
      var url = "/product/public/search" + "?keyword=" + keyword + "&company_id=" + company_id + "&price_min=" + price_min + "&price_max=" + price_max + "&stock_min=" + stock_min + "&stock_max=" + stock_max;
      $('#get-page').attr('data', url);

      if(!price_min){
         price_min = 0;
      };
      if(!stock_min){
         stock_min = 0;
      };

      //通信開始
      $.ajax({
         type:"get",
         url:url,
         data: {
            'keyword': keyword, 
            'company_id': company_id,             
            'price_min': price_min, 
            'price_max': price_max,             
            'stock_min': stock_min, 
            'stock_max': stock_max,    
         },
         dataType: 'json',
      })   
      .done(function (data){
      // 取得成功
      var pagedata = data;
      var data = data.products.data
      var html = '';
      //一覧表示リセット
      var $result = $('#addlist');
      $result.empty();

      //検索結果更新
         $.each(data, function(data,value) {
            var id = value.id;
            var name = value.product_name;
            var img = "http://localhost:8888/product/public" + value.img_path;
            var price = value.price;
            var stock = value.stock;
            var company_name = value.company_name;
      //更新データ表示
            html = `
               <tr id="${id}">
                  <td>${id}</td>
                  <td><img src=${img} class="img_list"></td>
                  <td>${name}</td>
                  <td>¥${price}</td>
                  <td>${stock}</td>
                  <td>${company_name}</td>

                  <td class="btn-show-del">
                        <a href="{{ route('product.show', ['id'=>$value->id] ) }}" class="btn btn-info">詳細</a>
                        <form action="{{ route('product.delete', ['id'=>$value->id]) }}" method="POST">
                           <button type="submit" class="btn btn-danger btn-del" value="${id}">削除</button>
                        </form>
                  </td>
               </tr>
            `
            $result.append(html);
         })
         //page再生成
         createPagintion(pagedata);
      })
      
      //通信が失敗したとき
      .fail(function (jqXHR, textStatus, errorThrown) {
         // 通信失敗時の処理
         console.log("ajax通信に失敗しました");
         console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
         console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
         console.log("errorThrown    : " + errorThrown.message); // 例外情報
         console.log("URL            : " + url);
         console.log(data);
         alert('ファイルの取得に失敗しました。');
      });
   });
});

//入力リセット
$(function(){
   $('#btn-clear').click(function() {
      var keyword = document.getElementById('keyword');
      var company_id = document.getElementById('company_id');   
      var price_min = document.getElementById('price_min');   
      var price_max = document.getElementById('price_max');   
      var stock_min = document.getElementById('stock_min');   
      var stock_max = document.getElementById('stock_max');   
      keyword.value = "";
      company_id.value = ""; 
      price_min.value = ""; 
      price_max.value = ""; 
      stock_min.value = ""; 
      stock_max.value = ""; 

   });
});

//ソート
$(function() {
   $('.sort_data').click(function(event) {
      event.preventDefault();
      var order = $('.sort_data').data();
      console.log(order);
      //検索値取得
      var url = "/product/public/search" + "?keyword=" + keyword + "&company_id=" + company_id + "&price_min=" + price_min + "&price_max=" + price_max + "&stock_min=" + stock_min + "&stock_max=" + stock_max;


      //通信開始
      $.ajax({
         type:"get",
         url:url,
         data: {
            'keyword': keyword, 
            'company_id': company_id,             
            'price_min': price_min, 
            'price_max': price_max,             
            'stock_min': stock_min, 
            'stock_max': stock_max,    
         },
         dataType: 'json',
      })   
      .done(function (data){
      })
      //通信が失敗したとき
      .fail(function (jqXHR, textStatus, errorThrown) {
         // 通信失敗時の処理
         console.log("ajax通信に失敗しました");
         console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
         console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
         console.log("errorThrown    : " + errorThrown.message); // 例外情報
         console.log("URL            : " + url);
         console.log(data);
         alert('ファイルの取得に失敗しました。');
      });
   });
});

//削除
$(function() {
   $('.btn-del').click(function(event) {
      event.preventDefault();
      //削除値取得      
      var del = $(this);
      var del_id = del.attr('data-user_id');
      console.log(del_id);

      $.ajax({
         type:"POST",
         url:'/product/public/delete/' + del_id,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         },
         data: {'id' :del_id}
      })
      // 通信が成功したとき
         .done(function() {
            del.parents('tr').remove();
       })
      //通信が失敗したとき
      .fail(function (jqXHR, textStatus, errorThrown) {
         // 通信失敗時の処理
         console.log("ajax通信に失敗しました");
         console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
         console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
         console.log("errorThrown    : " + errorThrown.message); // 例外情報
         console.log("URL            : " + url);
         console.log(data);
         alert('ファイルの取得に失敗しました。');
      });   
   });
});