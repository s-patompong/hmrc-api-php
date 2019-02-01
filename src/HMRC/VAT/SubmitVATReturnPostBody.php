<?php


namespace HMRC\VAT;


use HMRC\Exceptions\InvalidPostBodyException;
use HMRC\Request\PostBody;

class SubmitVATReturnPostBody implements PostBody
{
    /** @var string */
    private $periodKey;

    /** @var float */
    private $vatDueSales;

    /** @var float */
    private $vatDueAcquisitions;

    /** @var float */
    private $totalVatDue;

    /** @var float */
    private $vatReclaimedCurrPeriod;

    /** @var float */
    private $netVatDue;

    /** @var float */
    private $totalValueSalesExVAT;

    /** @var float */
    private $totalValuePurchasesExVAT;

    /** @var float */
    private $totalValueGoodsSuppliedExVAT;

    /** @var float */
    private $totalAcquisitionsExVAT;

    /** @var bool */
    private $finalised;

    /**
     * Validate the post body, it should throw an Exception if something is wrong
     *
     * @throws InvalidPostBodyException
     */
    public function validate()
    {
        $requiredFields = [
            "periodKey",
            "vatDueSales",
            "vatDueAcquisitions",
            "totalVatDue",
            "vatReclaimedCurrPeriod",
            "netVatDue",
            "totalValueSalesExVAT",
            "totalValuePurchasesExVAT",
            "totalValueGoodsSuppliedExVAT",
            "totalAcquisitionsExVAT",
            "finalised",
        ];

        $emptyFields = [];
        foreach ($requiredFields as $requiredField) {
            if(is_null($this->{$requiredField})) {
                $emptyFields[] = $requiredField;
            }
        }

        if(count($emptyFields) > 0) {
            $emptyFieldsString = implode(", ", $emptyFields);

            throw new InvalidPostBodyException("Missing post body fields ({$emptyFieldsString}).");
        }
    }

    /**
     * Return post body as an array to be used to call
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "periodKey" => $this->periodKey,
            "vatDueSales" => $this->vatDueSales,
            "vatDueAcquisitions" => $this->vatDueAcquisitions,
            "totalVatDue" => $this->totalVatDue,
            "vatReclaimedCurrPeriod" => $this->vatReclaimedCurrPeriod,
            "netVatDue" => $this->netVatDue,
            "totalValueSalesExVAT" => $this->totalValueSalesExVAT,
            "totalValuePurchasesExVAT" => $this->totalValuePurchasesExVAT,
            "totalValueGoodsSuppliedExVAT" => $this->totalValueGoodsSuppliedExVAT,
            "totalAcquisitionsExVAT" => $this->totalAcquisitionsExVAT,
            "finalised" => $this->finalised,
        ];
    }

    /**
     * @param string $periodKey
     *
     * @return SubmitVATReturnPostBody
     */
    public function setPeriodKey(string $periodKey): SubmitVATReturnPostBody
    {
        $this->periodKey = $periodKey;

        return $this;
    }

    /**
     * @param float $vatDueSales
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatDueSales(float $vatDueSales): SubmitVATReturnPostBody
    {
        $this->vatDueSales = $vatDueSales;

        return $this;
    }

    /**
     * @param float $vatDueAcquisitions
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatDueAcquisitions(float $vatDueAcquisitions): SubmitVATReturnPostBody
    {
        $this->vatDueAcquisitions = $vatDueAcquisitions;

        return $this;
    }

    /**
     * @param float $totalVatDue
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalVatDue(float $totalVatDue): SubmitVATReturnPostBody
    {
        $this->totalVatDue = $totalVatDue;

        return $this;
    }

    /**
     * @param float $vatReclaimedCurrPeriod
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatReclaimedCurrPeriod(float $vatReclaimedCurrPeriod): SubmitVATReturnPostBody
    {
        $this->vatReclaimedCurrPeriod = $vatReclaimedCurrPeriod;

        return $this;
    }

    /**
     * @param float $netVatDue
     *
     * @return SubmitVATReturnPostBody
     */
    public function setNetVatDue(float $netVatDue): SubmitVATReturnPostBody
    {
        $this->netVatDue = $netVatDue;

        return $this;
    }

    /**
     * @param float $totalValueSalesExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValueSalesExVAT(float $totalValueSalesExVAT): SubmitVATReturnPostBody
    {
        $this->totalValueSalesExVAT = $totalValueSalesExVAT;

        return $this;
    }

    /**
     * @param float $totalValuePurchasesExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValuePurchasesExVAT(float $totalValuePurchasesExVAT): SubmitVATReturnPostBody
    {
        $this->totalValuePurchasesExVAT = $totalValuePurchasesExVAT;

        return $this;
    }

    /**
     * @param float $totalValueGoodsSuppliedExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValueGoodsSuppliedExVAT(float $totalValueGoodsSuppliedExVAT): SubmitVATReturnPostBody
    {
        $this->totalValueGoodsSuppliedExVAT = $totalValueGoodsSuppliedExVAT;

        return $this;
    }

    /**
     * @param float $totalAcquisitionsExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalAcquisitionsExVAT(float $totalAcquisitionsExVAT): SubmitVATReturnPostBody
    {
        $this->totalAcquisitionsExVAT = $totalAcquisitionsExVAT;

        return $this;
    }

    /**
     * @param bool $finalised
     *
     * @return SubmitVATReturnPostBody
     */
    public function setFinalised(bool $finalised): SubmitVATReturnPostBody
    {
        $this->finalised = $finalised;

        return $this;
    }
}
