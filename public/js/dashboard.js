let tr = $("tbody tr");
tr.on("click", function () {
   tr.removeClass('table-active'); // remove selected style from all rows 

   $(this).addClass('table-active'); // add selected style to clicked row
   let selectedId = $(this).children(":first").text()
   $("#btn-delete").val(selectedId)

   $("#edit-link").attr("href",`createEdit.php?edit&id=${selectedId}`)

})

tr.one("click",function() {
   $(".btn").removeClass("disabled")
})

