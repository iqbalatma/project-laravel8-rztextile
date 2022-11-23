export default {
  formatToRupiah:(number)=>{
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },

  rupiahToInt:(rupiah)=>{
    let rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
    rupiahInt = parseInt(rupiahInt);
    return rupiahInt;
  }

}
