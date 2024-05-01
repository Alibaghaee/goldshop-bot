<?php

namespace App\Service\Moadian;


use App\Traits\Service\HasBaseMethods;


use SnappMarketPro\Moadian\Dto\InvoiceBodyDto;
use SnappMarketPro\Moadian\Dto\InvoiceDto;
use SnappMarketPro\Moadian\Dto\InvoiceHeaderDto;
use SnappMarketPro\Moadian\Dto\InvoicePaymentDto;
use SnappMarketPro\Moadian\Dto\Packet;
use Datetime;

class InvoiceServiceController
{
    use HasBaseMethods;


    private $moadian;

    public function __construct($moadian)
    {
        $this->endPoint = env('MOADIAN_ENDPOINT');


        $this->moadian = $moadian;
    }

    public function setHeader($invoiceHeader): InvoiceHeaderDto
    {
        $taxId = $this->moadian->generateTaxId(new DateTime(), $invoiceHeader->invoice_id);  //1234567890  ,,,10 number ,$invoiceHeader->invoice_id

        $invoiceHeaderDto = (new InvoiceHeaderDto);

        $invoiceHeaderDto = $invoiceHeaderDto->setTaxid($taxId);
        if ($invoiceHeader->dpvb) {
            $invoiceHeaderDto = $invoiceHeaderDto->setDpvb($invoiceHeader->dpvb);
        }
        if ($invoiceHeader->Tax17) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTax17($invoiceHeader->Tax17);
        }
        if ($invoiceHeader->Tvam) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTvam($invoiceHeader->Tvam);
        }

        if ($invoiceHeader->Todam) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTodam($invoiceHeader->Todam);
        }
        if ($invoiceHeader->Indati2m->timestamp) {
            $invoiceHeaderDto = $invoiceHeaderDto->setIndati2m($invoiceHeader->Indati2m->timestamp);
        }
        if ($invoiceHeader->Indatim->timestamp) {
            $invoiceHeaderDto = $invoiceHeaderDto->setIndatim($invoiceHeader->Indatim->timestamp);
        }

        if ($invoiceHeader->Inty) {
            $invoiceHeaderDto = $invoiceHeaderDto->setInty($invoiceHeader->Inty);
        }

        if ($invoiceHeader->Ft) {
            $invoiceHeaderDto = $invoiceHeaderDto->setFt($invoiceHeader->Ft);
        }

        if ($invoiceHeader->Inno) {
            $invoiceHeaderDto = $invoiceHeaderDto->setInno($invoiceHeader->Inno);
        }
        if ($invoiceHeader->Irtaxid) {
            $invoiceHeaderDto = $invoiceHeaderDto->setIrtaxid($invoiceHeader->Irtaxid);
        }

        if ($invoiceHeader->Scln) {
            $invoiceHeaderDto = $invoiceHeaderDto->setScln($invoiceHeader->Scln);
        }
        if ($invoiceHeader->Setm) {
            $invoiceHeaderDto = $invoiceHeaderDto->setSetm($invoiceHeader->Setm);
        }
        if ($invoiceHeader->Tins) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTins($invoiceHeader->Tins);
        }

        if ($invoiceHeader->Cap) {
            $invoiceHeaderDto = $invoiceHeaderDto->setCap((int)$invoiceHeader->Cap);
        }

        if ($invoiceHeader->Bid) {
            $invoiceHeaderDto = $invoiceHeaderDto->setBid($invoiceHeader->Bid);
        }

        if ($invoiceHeader->Insp) {
            $invoiceHeaderDto = $invoiceHeaderDto->setInsp($invoiceHeader->Insp);
        }
        if ($invoiceHeader->Tvop) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTvop($invoiceHeader->Tvop);
        }

        if ($invoiceHeader->Bpc) {
            $invoiceHeaderDto = $invoiceHeaderDto->setBpc($invoiceHeader->Bpc);
        }


        if ($invoiceHeader->Inp) {
            $invoiceHeaderDto = $invoiceHeaderDto->setInp($invoiceHeader->Inp);
        }

        if ($invoiceHeader->Scc) {
            $invoiceHeaderDto = $invoiceHeaderDto->setScc($invoiceHeader->Scc);
        }

        if ($invoiceHeader->Ins) {
            $invoiceHeaderDto = $invoiceHeaderDto->setIns((int)$invoiceHeader->Ins);
        }
        if ($invoiceHeader->Billid) {
            $invoiceHeaderDto = $invoiceHeaderDto->setBillid($invoiceHeader->Billid);
        }

        if ($invoiceHeader->Tprdis) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTprdis((int)$invoiceHeader->Tprdis);
        }

        if ($invoiceHeader->Tdis) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTdis($invoiceHeader->Tdis);
        }

        if ($invoiceHeader->Tadis) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTadis((int)$invoiceHeader->Tadis);
        }

        if ($invoiceHeader->Tbill) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTbill((int)$invoiceHeader->Tbill);
        }

        if ($invoiceHeader->Tob) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTob($invoiceHeader->Tob);
        }

        if ($invoiceHeader->Tinb) {
            $invoiceHeaderDto = $invoiceHeaderDto->setTinb($invoiceHeader->Tinb);
        }

        if ($invoiceHeader->Sbc) {
            $invoiceHeaderDto = $invoiceHeaderDto->setSbc($invoiceHeader->Sbc);
        }

        if ($invoiceHeader->Bbc) {
            $invoiceHeaderDto = $invoiceHeaderDto->setBbc($invoiceHeader->Bbc);
        }

        if ($invoiceHeader->Bpn) {
            $invoiceHeaderDto = $invoiceHeaderDto->setBpn($invoiceHeader->Bpn);
        }

        if ($invoiceHeader->Crn) {
            $invoiceHeaderDto = $invoiceHeaderDto->setCrn($invoiceHeader->Crn);
        }


//        $invoiceHeaderDto
//            ->setIndati2m($invoiceHeader->Indati2m->timestamp)
//            ->setIndatim($invoiceHeader->Indatim->timestamp)
//            ->setInty($invoiceHeader->Inty)
//            ->setFt($invoiceHeader->Ft)
//            ->setInno($invoiceHeader->Inno)
//            ->setIrtaxid($invoiceHeader->Irtaxid)
//            ->setScln($invoiceHeader->Scln)
//            ->setSetm($invoiceHeader->Setm)
//            ->setTins($invoiceHeader->Tins)
//            ->setCap((int)$invoiceHeader->Cap)
//            ->setBid($invoiceHeader->Bid)
//            ->setInsp($invoiceHeader->Insp)
//            ->setTvop($invoiceHeader->Tvop)
//            ->setBpc($invoiceHeader->Bpc)
//            ->setTaxid($taxId)
//            ->setInp($invoiceHeader->Inp)
//            ->setScc($invoiceHeader->Scc)
//            ->setIns((int)$invoiceHeader->Ins)
//            ->setBillid($invoiceHeader->Billid)
//            ->setTprdis((int)$invoiceHeader->Tprdis)
//            ->setTdis($invoiceHeader->Tdis)
//            ->setTadis((int)$invoiceHeader->Tadis)
//            ->setTbill((int)$invoiceHeader->Tbill)
//            ->setTob($invoiceHeader->Tob)
//            ->setTinb($invoiceHeader->Tinb)
//            ->setSbc($invoiceHeader->Sbc)
//            ->setBbc($invoiceHeader->Bbc)
//            ->setBpn($invoiceHeader->Bpn)
//            ->setCrn($invoiceHeader->Crn);

        return $invoiceHeaderDto;
    }


    public function setBody($invoiceBody): InvoiceBodyDto
    {
        $invoiceBodyDto = (new InvoiceBodyDto);
        if ($invoiceBody->Sstid) {

            $invoiceBodyDto = $invoiceBodyDto->setSstid($invoiceBody->Sstid);
        }

        if ($invoiceBody->Sstt) {

            $invoiceBodyDto = $invoiceBodyDto->setSstt($invoiceBody->Sstt);
        }

        if ($invoiceBody->Mu) {

            $invoiceBodyDto = $invoiceBodyDto->setMu($invoiceBody->Mu);
        }

        if ($invoiceBody->Am) {

            $invoiceBodyDto = $invoiceBodyDto->setAm($invoiceBody->Am);
        }

        if ($invoiceBody->Fee) {

            $invoiceBodyDto = $invoiceBodyDto->setFee((int)$invoiceBody->Fee);
        }

        if ($invoiceBody->Cfee) {

            $invoiceBodyDto = $invoiceBodyDto->setCfee($invoiceBody->Cfee);
        }

        if ($invoiceBody->Cut) {

            $invoiceBodyDto = $invoiceBodyDto->setCut($invoiceBody->Cut);
        }

        if ($invoiceBody->Exr) {

            $invoiceBodyDto = $invoiceBodyDto->setExr($invoiceBody->Exr);
        }

        if ($invoiceBody->Prdis) {

            $invoiceBodyDto = $invoiceBodyDto->setPrdis((int)$invoiceBody->Prdis);
        }

        if ($invoiceBody->Dis) {

            $invoiceBodyDto = $invoiceBodyDto->setDis($invoiceBody->Dis);
        }

        if ($invoiceBody->Adis) {

            $invoiceBodyDto = $invoiceBodyDto->setAdis((int)$invoiceBody->Adis);
        }
        if ($invoiceBody->Odt) {

            $invoiceBodyDto = $invoiceBodyDto->setOdt($invoiceBody->Odt);
        }


        if ($invoiceBody->Odr) {

            $invoiceBodyDto = $invoiceBodyDto->setOdr($invoiceBody->Odr);
        }

        if ($invoiceBody->Odam) {

            $invoiceBodyDto = $invoiceBodyDto->setOdam($invoiceBody->Odam);
        }

        if ($invoiceBody->Olt) {

            $invoiceBodyDto = $invoiceBodyDto->setOlt($invoiceBody->Olt);
        }

        if ($invoiceBody->Olam) {

            $invoiceBodyDto = $invoiceBodyDto->setOlam($invoiceBody->Olam);
        }
        if ($invoiceBody->Consfee) {

            $invoiceBodyDto = $invoiceBodyDto->setConsfee($invoiceBody->Consfee);
        }

        if ($invoiceBody->Spro) {

            $invoiceBodyDto = $invoiceBodyDto->setSpro($invoiceBody->Spro);
        }

        if ($invoiceBody->Bros) {

            $invoiceBodyDto = $invoiceBodyDto->setBros($invoiceBody->Bros);
        }

        if ($invoiceBody->Tcpbs) {

            $invoiceBodyDto = $invoiceBodyDto->setTcpbs($invoiceBody->Tcpbs);
        }
        if ($invoiceBody->Cop) {

            $invoiceBodyDto = $invoiceBodyDto->setCop($invoiceBody->Cop);
        }

        if ($invoiceBody->Bsrn) {

            $invoiceBodyDto = $invoiceBodyDto->setBsrn($invoiceBody->Bsrn);
        }

        if ($invoiceBody->Vop) {

            $invoiceBodyDto = $invoiceBodyDto->setVop($invoiceBody->Vop);
        }
        if ($invoiceBody->Tsstam) {

            $invoiceBodyDto = $invoiceBodyDto->setTsstam($invoiceBody->Tsstam);
        }

        if ($invoiceBody->Vra) {
            $invoiceBodyDto = $invoiceBodyDto->setVra($invoiceBody->Vra);
        }
        if ($invoiceBody->Vam) {
            $invoiceBodyDto = $invoiceBodyDto->setVam($invoiceBody->Vam);
        }
//        $invoiceBodyDto = (new InvoiceBodyDto)
//            ->setSstid($invoiceBody->Sstid)
//            ->setSstt($invoiceBody->Sstt)
//            ->setMu($invoiceBody->Mu)
//            ->setAm($invoiceBody->Am)
//            ->setFee((int)$invoiceBody->Fee)
//            ->setCfee($invoiceBody->Cfee)
//            ->setCut($invoiceBody->Cut)
//            ->setExr($invoiceBody->Exr)
//            ->setPrdis((int)$invoiceBody->Prdis)
//            ->setDis($invoiceBody->Dis)
//            ->setAdis((int)$invoiceBody->Adis)
//            ->setOdt($invoiceBody->Odt)
//            ->setOdr($invoiceBody->Odr)
//            ->setOdam($invoiceBody->Odam)
//            ->setOlt($invoiceBody->Olt)
//            ->setOlr($invoiceBody->Olr)
//            ->setOlam($invoiceBody->Olam)
//            ->setConsfee($invoiceBody->Consfee)
//            ->setSpro($invoiceBody->Spro)
//            ->setBros($invoiceBody->Bros)
//            ->setTcpbs($invoiceBody->Tcpbs)
//            ->setCop($invoiceBody->Cop)
//            ->setBsrn($invoiceBody->Bsrn)
//            ->setVop($invoiceBody->Vop)
//            ->setTsstam($invoiceBody->Tsstam);
//            dd($invoiceBodyDto);
        return $invoiceBodyDto;
    }

    public function setPayment($invoicePayment): InvoicePaymentDto
    {
        $invoicePaymentDto = (new InvoicePaymentDto);

        if ($invoicePayment->Iinn) {
            $invoicePaymentDto = $invoicePaymentDto->setIinn($invoicePayment->Iinn);

        }

        if ($invoicePayment->Acn) {
            $invoicePaymentDto = $invoicePaymentDto->setAcn($invoicePayment->Acn);

        }
        if ($invoicePayment->Trmn) {
            $invoicePaymentDto = $invoicePaymentDto->setTrmn($invoicePayment->Trmn);

        }

        if ($invoicePayment->Trn) {
            $invoicePaymentDto = $invoicePaymentDto->setTrn($invoicePayment->Trn);

        }

        if ($invoicePayment->Pcn) {
            $invoicePaymentDto = $invoicePaymentDto->setPcn($invoicePayment->Pcn);

        }

        if ($invoicePayment->Pid) {
            $invoicePaymentDto = $invoicePaymentDto->setPid($invoicePayment->Pid);

        }
        if ($invoicePayment->Pid) {
            $invoicePaymentDto = $invoicePaymentDto->setPid($invoicePayment->Pid);

        }
        if (optional($invoicePayment->Pdt)->timestamp) {
            $invoicePaymentDto = $invoicePaymentDto->setPdt(optional($invoicePayment->Pdt)->timestamp);
        }


//            ->setIinn($invoicePayment->Iinn)
//        ->setAcn($invoicePayment->Acn)
//            ->setTrmn($invoicePayment->Trmn)
//            ->setTrn($invoicePayment->Trn)
//        ->
//        setPcn($invoicePayment->Pcn)
//        ->
//        setPid($invoicePayment->Pid);
//        if (optional($invoicePayment->Pdt)->timestamp) {
//            $invoicePaymentDto->setPdt(optional($invoicePayment->Pdt)->timestamp);
//        }


        return $invoicePaymentDto;
    }


    public function setInvoice($header, $body, $payments): InvoiceDto
    {
        $invoiceDto = (new InvoiceDto)
            ->setHeader($header)
            ->setBody([$body]);
//            ->setPayments([$payments]);

        return $invoiceDto;
    }


    public function setPacket($invoiceDto, $packet): Packet
    {
//        $packet = (new Packet($packet->packet_type, $invoiceDto))
//            ->setFiscalId($packet->account->username)
//            ->setDataSignature($packet->account->data_signature)
//            ->setEncryptionKeyId($packet->account->encryption_key_id)
//            ->setIv($packet->account->iv)
//            ->setSymmetricKey($packet->account->symmetric_key);


        $packet = (new Packet($packet->packet_type, $invoiceDto))
            ->setFiscalId('A29W6F');
//            ->setDataSignature(null)
//            ->setEncryptionKeyId(null)
//            ->setIv(null)
//            ->setSymmetricKey(null);

        return $packet;
    }

    public function inquiryByReferenceNumberD(string $referenceNumber)
    {

        $token = $this->moadian->getToken();
        $res = $this->moadian
            ->setToken($token)
            ->inquiryByReferenceNumber($referenceNumber);

        return $res;
    }

    public function inquiryByUuidD(string $referenceNumber)
    {

        $token = $this->moadian->getToken();
        $res = $this->moadian
            ->setToken($token)
            ->inquiryByReferenceNumber($referenceNumber);

        return $res;
    }


}
