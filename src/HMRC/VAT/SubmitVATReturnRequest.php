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

    protected function getVatApiPath(): string
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

    protected function getVATPostBody(): array
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

    protected function getRequiredClassAttributes(): array
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
