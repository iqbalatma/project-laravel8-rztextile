export default {
  formatIntToRupiah:(number)=>{
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },

  formatRupiahToInt:(rupiah)=>{
    let rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
    rupiahInt = rupiahInt.split(" ")[0];
    rupiahInt = parseInt(rupiahInt);
    return rupiahInt;
  }

}
