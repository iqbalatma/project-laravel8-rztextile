import Swal from "sweetalert2";
import helper from '../../../utils/helper';


function purchase(dataSet) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/shopping/purchase",
        context: document.body,
        data: dataSet,
        method: "POST",
    })
        .done(function (response) {
            console.log(response);

            if (response.status == 200) {
                let title = "Purchasing successfully!";
                if (
                    parseInt(dataSet.total_bill) < parseInt(dataSet.paid_amount)
                ) {
                    let change =
                        parseInt(dataSet.paid_amount) -
                        parseInt(dataSet.total_bill);
                    change = helper.formatIntToRupiah(change);
                    title = "Purchasing successfully! Change " + change;
                }
                Swal.fire({
                    icon: "success",
                    title: title,
                }).then((result) => {
                    window.open(
                        "/invoices/stream/" + response.data.id,
                        "_blank"
                    );
                    window.location.href = `/shopping`;
                });
            }
        })
        .fail(function (response) {
            console.log(response);
            Swal.fire({
                icon: "failed",
                title: "Purchasing failed. Something went wrong !",
            }).then((result) => {
                window.location.href = `/shopping`;
            });
        });
}

export default {
    onClickConfirm() {
        let totalBill = helper.formatRupiahToInt($("#total-bill").val());
        let finalBill = totalBill;
        const isHaveVoucher = $("#is-have-voucher").is(":checked");
        let voucherId = null;
        if (isHaveVoucher) {
            finalBill = helper.formatRupiahToInt($("#final-bill").val());
            voucherId = $("#voucher_id").val();
        }
        let dataSet = {
            customer_id: null,
            payment_type: $("#payment-type").find("option:selected").val(),
            total_bill: totalBill,
            final_bill: finalBill,
            paid_amount: $("#paid-amount").val(),
            rolls: [],
            voucher_id: voucherId,
        };

        let isCustomDate = $("#btn-check-custom-date").is(":checked");

        if(isCustomDate){
            if($("#custom-date").val()==""){
                return Swal.fire("Custom date is required");
            }
            dataSet.custom_date = $("#custom-date").val();

        }

        let isWithCustomer = $("#is-with-customer").is(":checked");
        let selectedCustomer = $("#select-customer")
            .find("option:selected")
            .val();

        if (isWithCustomer && selectedCustomer != "") {
            dataSet.customer_id = selectedCustomer;
        }

        let tableRows = $("#summary-payment-container tbody tr");

        tableRows.each(function () {
            let roll_id = $(this).find("td").eq(0).text();
            let quantity_roll = parseInt($(this).find("td").eq(3).text());
            let quantity_unit = parseInt($(this).find("td").eq(5).text());
            let sub_total = helper.formatRupiahToInt(
                $(this).find("td").eq(7).text()
            );

            let roll = { roll_id, quantity_roll, quantity_unit, sub_total };

            dataSet.rolls.push(roll);
        });

        purchase(dataSet);
    },
};
