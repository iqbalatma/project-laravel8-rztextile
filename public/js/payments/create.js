$(document).ready((function(){console.log("TES"),$("#invoice").on("change",(function(){console.log("change triggered");var e=$(this).find(":selected").data("bill-left");$("#bill_left").val(e)}))}));