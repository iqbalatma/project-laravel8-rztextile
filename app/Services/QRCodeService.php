<?php 
namespace App\Services;

use App\AppData;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeService{

  public function storeNewQRCode($code = "code"):string
  {
    $qrcode = QrCode::format("png")
              ->size(200)->errorCorrection('H')
              ->generate($code);

    $path = '/images/qrcode/' . randomString(16) . '.png';
    Storage::disk('local')->put($path, $qrcode); 
    

    return basename($path);
  }

  /**
   * Description : use to get generated barcode code
   * 
   * @return string of generated barcode
   */
  public function getGeneratedQrCode():string
  {
    return randomString(AppData::BARCODE_LENGTH);
  }
}

?>