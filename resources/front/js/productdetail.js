$(document).ready(function() {
    checkttsp();
}); 
function checkttsp()
{
    var url =$(location).attr('href');
     
    $.ajax({
        type:"POST",
        url: getUrspal() + "productdetail/checkttsp",
        dataType:"text",
        data: {
            url: url},
        cache:false,
        success:function (data) {
            checkttsp_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function checkttsp_Complete(data)
{
    var sRes = JSON.parse(data);
    //alert(sRes);
    if(sRes.flag == 1 || sRes.flag == "1")
    {
        checkpromotion(sRes.masp);
    }    
}
function checkpromotion(masp)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "productdetail/checkpromotion",
        dataType:"text",
        data: {
            masp: masp},
        cache:false,
        success:function (data) {
            checkpromotion_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function checkpromotion_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes !== null) {
            showdetailpro(sRes.masp,sRes.promotionid);
    }
}
function showdetailpro(id,promotionid)
{
    BackToChooseDay();
    var ID=id;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/getdetailpro",
        dataType:"text",
        data: {
            masp: ID,
            promotionid: promotionid},
        cache:false,
        success:function (data) {
            showdetailpro_complete(data);
            //alert(data);
        }
    });
}
//divTheCalendar div.supercal-footer span.supercal-input

function showdetailpro_complete(data) { 
    var sRes = JSON.parse(data);
    if (sRes !== null) {
        var pro = sRes.Product;
        var pri = sRes.Price;
        var proTime = sRes.ProductTime;
        var spa = sRes.Spa;
        var loc = sRes.Location;
        var spaTime = sRes.SpaTime;
        var comment  = sRes.Comment;
        var commentcon = sRes.CommentCon;
        var comentcreadedBy = sRes.CreadbyComment;
        //alert(comment);

        $("#imgProductLinks").attr("src", sRes.ImgLinks);
        $("#promotionid").attr("value",sRes.promotionid);
        if (pri != null) {
            if(sRes.promotionid != 0 && sRes.promotionid!="0")
            {
                //alert(sRes.price_save);
                $(".spanProductPrice").html('<strike id="firstprice">'+pri.Price+'</strike>');
                $("#firstprice").number(true,0);
                $("#spanProductSavePrice").html(sRes.price_save);
                $("#spanProductSavePrice").number(true,0);
                $("#divsaveprice").show();
            }
            else
            {
                $(".spanProductPrice").html(pri.Price);
                $(".spanProductPrice").number(true,0);
                $("#divsaveprice").hide();
            }
            //$(".spanProductPrice").number(true,0);
        }

        if (pro != null) {
            $("#spanProductName").text(pro.Name);
            $("#txtProductID").val(pro.ProductID);
            $("#divProductDetail0").html(pro.Description);
            $("#divProductDetail1").html(pro.Policy);
            $("#divProductDetail2").html(pro.Restriction);
            $("#divProductDetail3").html(pro.Tips);
            $(".spanProductDuration").text(pro.Duration);
            $("#buttonBookProduct").attr("onclick", "BookThisProduct('" + pro.ProductID + "');");
        }
        
        if (spa != null) {
            $link = "spadetail/index/" + spa.spaID;
            $("#linkspa").attr("href",$link );
            $(".spanSpaName").html(spa.spaName);
            $(".spanSpaAddress").html(spa.Address);

            $("#myModalLabel").html(spa.spaName);
            $("#spanSpaNameModalLabelService").html(spa.spaName);
            var locStr = spa.Location;
            var locArr = locStr.split('|');
            var loc_content = locArr[1];
            var toadoArr = locArr[0].split(',');
            var td_x = parseFloat(toadoArr[0]);
            var td_y = parseFloat(toadoArr[1]);
            init_map(td_x, td_y, loc_content);
            google.maps.event.addDomListener(window, 'load', init_map);
            $(".spanSpaTel").text(spa.Tel);
            $(".spanSpaEmail").text(spa.Email);
            $(".spanSpaWebsite").text(spa.Website);
            $("a.spanSpaWebsite").attr("href","http://"+spa.Website);
        }

        if (loc != null) {
            $(".spanLoactionSpa").text(loc.StrValue1);
            $("#spanLoactionSpa").text(loc.StrValue1);
        }
        
        // add them comment cho popup for product
        if(comment != null){
            if(comment.length > 0){
                 $(".wrap-review-list div").remove();
                  var str = "";
                  for (var i = 0; i < comment.length; i++) {
                      str = str + "<div class=\"wrap-2cols nav-left wrap-review\">";
                      if(comentcreadedBy != null){
                         for(var h = 0; h < comentcreadedBy.length; h++){
                             if(comentcreadedBy[h].UserId == comment[i].CreatedBy){
                                 
                                  var image = comentcreadedBy[h].Avatar;
                                  if(image == ""){
                                      image = "resources/front/images/no-pic-avatar.png";
                                  }
                                  str = str + "<div class=\"col-nav\"><div class=\"wrap-thumb\" style=\"background-image:url("+image+")\"></div></div>";
                                  str = str + "<div class=\"col-content\">";
                                  str = str + "<div class=\"content\">";
                                  str = str + "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
                                  str = str + "<tr><td><strong>"+ comentcreadedBy[h].FullName+ "</strong></td> <td align=\"right\">"+ comment[i].CreatedDate +"</td></tr>";
                             }
                            
                         }
                      }
                      
                      
                      str = str + "<tr><td colspan= \"2\">"+ comment[i].Content;
                      str = str + "<div id=\"wrap-add-comment2-popup\" class=\"wrap-add-comment\" style=\"\display:none\">";
                      str = str + "<form role=\"form\">";
                      str = str + "<div class=\"form-group\" ><lable>Nội dung bình luận</lable>";
                      str = str + "<textarea class=\"form-control\" rows=\"3\" id=\"ContentCommetCon\"></textarea>";
                      str = str + "</div>";
                      str = str + "<a href=\"javascript:void(0)\" onclick= \"SendCommentCon("+comment[i].id+")\" class=\"btn btn-default pull-right\">Gởi Bình Luận</a>";
                      str = str + "<a onclick=\"$('#wrap-add-comment2-popup').toggle(300);\">Bình Luận</a>";
                      str = str + "<span id=\"MessageCon2\"></span>";
                      if(commentcon != null){
                          if(commentcon.length > 0){
                              for(var j = 0; j <commentcon.length ; j++){
                                   if(commentcon[j].ParentID == comment[i].id){
                                        str = str + "<div class=\"wrap-2cols nav-left wrap-review\">";
                                        if(comentcreadedBy != null){
                                            for(var e = 0; e < comentcreadedBy.length; e++){
                                                if(comentcreadedBy[e].UserId == commentcon[j].CreatedBy){
                                                     var image = comentcreadedBy[e].Avatar;
                                                      if(image == ""){
                                                          image = "resources/front/images/no-pic-avatar.png";
                                                      }
                                                      
                                                      str = str + "<div class=\"col-nav\"><div class=\"wrap-thumb\" style=\"background-image:url("+image+")\"></div></div>";
                                                     str = str + "<div class=\"col-content\">";
                                                     str = str + "<div class=\"content\">";
                                                     str = str + "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
                                                     str = str + "<tr><td><strong>"+ comentcreadedBy[e].FullName+ "</strong></td> <td align=\"right\">"+ commentcon[j].CreatedDate +"</td></tr>";
                                                }
                                            }
                                        }
                                        
                                          str = str + "<tr><td colspan= \"2\">"+ commentcon[j].Content + "</td></tr>";
                                          str = str + "</tbody></table>";
                                          str = str + "</div>";
                                          str = str + "</div>";
                                          str = str + "</div>";
                                   }
                              }
                              
                          }
                      }
                      str = str + "</td></tr>";
                      if(commentcon == null)
                      {
                           str = str + "<tr><td align=\"right\" colspan=\"2\">";
                          str = str + "<a onclick=\"$('#wrap-add-comment2-popup').toggle(300);\">Bình Luận</a>";
                          str = str + "</td></tr>";
                          str = str + "<tr><td colspan=\"2\">";
                          str = str + "<div id=\"wrap-add-comment2-popup\" class=\"wrap-add-comment\" style=\"\display:none\">";
                          str = str + "<form role=\"form\">";
                          str = str + "<div class=\"form-group\" ><lable>Nội dung bình luận</lable>";
                          str = str + "<textarea class=\"form-control\" rows=\"3\" id=\"ContentCommetCon\"></textarea>";
                          str = str + "</div>";
                          str = str + "<a href=\"javascript:void(0)\" onclick= \"SendCommentCon("+comment[i].id+")\" class=\"btn btn-default pull-right\">Gởi Bình Luận</a>";
                          str = str + "<span id=\"messageCommentCon\"></span>";
                          str = str + "</form></div>";
                          str = str + "</td></tr>";
                      }
                     

                      str = str + "</tbody></table>";
                      str = str + "</div>";
                      str = str + "</div>";
                      str = str + "</div>";
                  }
                 $(".wrap-review-list").html(str);
                 alert(str);
            }  
        }
        else{
            $(".wrap-review-list").remove();
        }
        //tableSpaWorkingTime
        if (spaTime != null) {
            //var tt = $("#tableSpaWorkingTime tbody tr:last").index() + 1;
            if (spaTime.length > 0) {
                $("#tableSpaWorkingTime tbody tr").remove();
                var str = "";
                for (var i = 0; i < spaTime.length; i++) {
                    if (spaTime[i].DayOfWeek == "2" || spaTime[i].DayOfWeek == 2) {
                        str = str + "<tr><td nowrap=\"nowrap\">MON</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom +":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "3" || spaTime[i].DayOfWeek == 3) {
                        str = str + "<tr><td nowrap=\"nowrap\">TUE</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "4" || spaTime[i].DayOfWeek == 4) {
                        str = str + "<tr><td nowrap=\"nowrap\">WED</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "5" || spaTime[i].DayOfWeek == 5) {
                        str = str + "<tr><td nowrap=\"nowrap\">THU</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "6" || spaTime[i].DayOfWeek == 6) {
                        str = str + "<tr><td nowrap=\"nowrap\">FRI</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "7" || spaTime[i].DayOfWeek == 7) {
                        str = str + "<tr><td nowrap=\"nowrap\">SAT</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "8" || spaTime[i].DayOfWeek == 8) {
                        str = str + "<tr><td nowrap=\"nowrap\">SUN</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo + 
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "9" || spaTime[i].DayOfWeek == 9) {
                        str = str + "<tr><td nowrap=\"nowrap\">HOLIDAYS</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                }
                $("#tableSpaWorkingTime tbody").append(str);
            }
        }
    }
    
    $(".wrap-times").hide(0);
    $("#buttonBookProduct").hide((0));
    
}