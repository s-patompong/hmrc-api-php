<?php


namespace HMRC\VAT;


use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class SubmitVATReturnRequest extends VATPostRequest
{
    /** @var string */
    protected $periodKey;

    /** @var float */
    protected $vatDueSales;

    /** @var float */
    protected $vatDueAcquisitions;

    /** @var float */
    protected $totalVatDue;

    /** @var float */
    protected $vatReclaimedCurrPeriod;

    /** @var float */
    protected $netVatDue;

    /** @var float */
    protected $totalValueSalesExVAT;

    /** @var float */
    protected $totalValuePurchasesExVAT;

    /** @var float */
    protected $totalValueGoodsSuppliedExVAT;

    /** @var float */
    protected $totalAcquisitionsExVAT;

    /** @var bool */
    protected $finalised;

    public function __construct(string $vrn)
    {
        parent::__construct($vrn);
    }

    protected function getVatApiPath()
    {
        return '/returns';
    }

    /**
     * @return string
     */
    public function getPeriodKey(): string
    {
        return $this->periodKey;
    }

    protected function getVATPostOptions()
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

    protected function getRequiredClassAttributes()
    {
        return [
            'periodKey',
            'vatDueSales',
            'vatDueAcquisitions',
            'totalVatDue',
            'vatReclaimedCurrPeriod',
            'netVatDue',
            'totalValueSalesExVAT',
            'totalValuePurchasesExVAT',
            'totalValueGoodsSuppliedExVAT',
            'totalAcquisitionsExVAT',
            'finalised',
        ];
    }

    /**
     * @param string $periodKey
     *
     * @return SubmitVATReturnRequest
     */
    public function setPeriodKey(string $periodKey): SubmitVATReturnRequest
    {
        $this->periodKey = $periodKey;

        return $this;
    }

    /**
     * @return float
     */
    public function getVatDueSales(): float
    {
        return $this->vatDueSales;
    }

    /**
     * @param float $vatDueSales
     *
     * @return SubmitVATReturnRequest
     */
    public function setVatDueSales(float $vatDueSales): SubmitVATReturnRequest
    {
        $this->vatDueSales = $vatDueSales;

        return $this;
    }

    /**
     * @return float
     */
    public function getVatDueAcquisitions(): float
    {
        return $this->vatDueAcquisitions;
    }

    /**
     * @param float $vatDueAcquisitions
     *
     * @return SubmitVATReturnRequest
     */
    public function setVatDueAcquisitions(float $vatDueAcquisitions): SubmitVATReturnRequest
    {
        $this->vatDueAcquisitions = $vatDueAcquisitions;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalVatDue(): float
    {
        return $this->totalVatDue;
    }

    /**
     * @param float $totalVatDue
     *
     * @return SubmitVATReturnRequest
     */
    public function setTotalVatDue(float $totalVatDue): SubmitVATReturnRequest
    {
        $this->totalVatDue = $totalVatDue;

        return $this;
    }

    /**
     * @return float
     */
    public function getVatReclaimedCurrPeriod(): float
    {
        return $this->vatReclaimedCurrPeriod;
    }

    /**
     * @param float $vatReclaimedCurrPeriod
     *
     * @return SubmitVATReturnRequest
     */
    public function setVatReclaimedCurrPeriod(float $vatReclaimedCurrPeriod): SubmitVATReturnRequest
    {
        $this->vatReclaimedCurrPeriod = $vatReclaimedCurrPeriod;

        return $this;
    }

    /**
     * @return float
     */
    public function getNetVatDue(): float
    {
        return $this->netVatDue;
    }

    /**
     * @param float $netVatDue
     *
     * @return SubmitVATReturnRequest
     */
    public function setNetVatDue(float $netVatDue): SubmitVATReturnRequest
    {
        $this->netVatDue = $netVatDue;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalValueSalesExVAT(): float
    {
        return $this->totalValueSalesExVAT;
    }

    /**
     * @param float $totalValueSalesExVAT
     *
     * @return SubmitVATReturnRequest
     */
    public function setTotalValueSalesExVAT(float $totalValueSalesExVAT): SubmitVATReturnRequest
    {
        $this->totalValueSalesExVAT = $totalValueSalesExVAT;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalValuePurchasesExVAT(): float
    {
        return $this->totalValuePurchasesExVAT;
    }

    /**
     * @param float $totalValuePurchasesExVAT
     *
     * @return SubmitVATReturnRequest
     */
    public function setTotalValuePurchasesExVAT(float $totalValuePurchasesExVAT): SubmitVATReturnRequest
    {
        $this->totalValuePurchasesExVAT = $totalValuePurchasesExVAT;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalValueGoodsSuppliedExVAT(): float
    {
        return $this->totalValueGoodsSuppliedExVAT;
    }

    /**
     * @param float $totalValueGoodsSuppliedExVAT
     *
     * @return SubmitVATReturnRequest
     */
    public function setTotalValueGoodsSuppliedExVAT(float $totalValueGoodsSuppliedExVAT): SubmitVATReturnRequest
    {
        $this->totalValueGoodsSuppliedExVAT = $totalValueGoodsSuppliedExVAT;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalAcquisitionsExVAT(): float
    {
        return $this->totalAcquisitionsExVAT;
    }

    /**
     * @param float $totalAcquisitionsExVAT
     *
     * @return SubmitVATReturnRequest
     */
    public function setTotalAcquisitionsExVAT(float $totalAcquisitionsExVAT): SubmitVATReturnRequest
    {
        $this->totalAcquisitionsExVAT = $totalAcquisitionsExVAT;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinalised(): bool
    {
        return $this->finalised;
    }

    /**
     * @param bool $finalised
     *
     * @return SubmitVATReturnRequest
     */
    public function setFinalised(bool $finalised): SubmitVATReturnRequest
    {
        $this->finalised = $finalised;

        return $this;
    }

    /**
     * Get class that deal with government test scenario
     *
     * @return GovernmentTestScenario
     */
    protected function getGovTestScenarioClass(): GovernmentTestScenario
    {
        return new SubmitVATReturnGovTestScenario;
    }
}
