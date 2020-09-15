(function($){
    $('#select-year').change(function(){
        $.ajax({
            url:selectyear.ajaxurl,
            method: "POST",
            data: {
                "action": "filterYear",
                "year":$(this).find(':selected').val()
            },
            beforeSend: function(){
                $('#articles-this-year').html("Cargando...");
            },
            success: function(data){
                console.log(data);
                let html=`<table>
                <tr>
                <th>id_article</th>
                <th>title</th>
                <th>id_magazine</th>
                </tr>`;
                data.forEach(item=>{
                    html+=`<tr>
                    <td>${item.id}</td>
                    <td>${item.title}</td>
                    <td>${item.magazine}</td>
                    </tr>`
                })
                html+=`</table>`;
                $("#articles-this-year").html(html);

            },
            error: function(error){
                console.log(error)
            }
        })
    })
})(jQuery);