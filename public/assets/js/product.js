$(function() {
   $('#btn').click(function(event) {
      event.preventDefault();
      var keyword = $('#keyword').val();
      var company_id = $('#company_id').val();
      var url = "/product/public/search" + "?keyword=" + keyword + "&company_id=" + company_id

      $.ajax({
         type:"get",
         url:url,
         data: {
            'keyword': keyword, 
            'company_id': company_id,             
         },
         dataType: 'json',
      })   
      .done(function (data){
      // 取得成功
         var data = data.products.data
         var html = '';
      //一覧表示リセット
         var $result = $('#addArea');
         $result.empty();
      //入力リセット
         var keyword = document.getElementById('keyword');
         var company_id = document.getElementById('company_id');   
         keyword.value = "";
         company_id.value = ""; 
         
      //検索結果更新
         $.each(data, function(data, value) {
            var id = value.id;
            var name = value.product_name;
            var img = "http://localhost:8888/product/public" + value.img_path;
            var price = value.price;
            var stock = value.stock;
            var company_name = value.company_name;
      //更新データ表示
            html = `
               <tr>
                  <td>${id}</td>
                  <td><img src=${img} class="img_list"></td>
                  <td>${name}</td>
                  <td>¥${price}</td>
                  <td>${stock}</td>
                  <td>${company_name}</td>

                  <td class="btn-show-del">
                        <a href="{{ route('product.show', ['id'=>$value->id] ) }}" class="btn btn-info">詳細</a>
                        <form action="{{ route('product.delete', ['id'=>$value->id]) }}" method="POST">
                           <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                  </td>
               </tr>
            `
            $result.append(html);
         })
         
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