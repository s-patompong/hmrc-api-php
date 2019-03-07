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
     * Validate the post body, it should throw an Exception if something is wrong.
     *
     * @throws InvalidPostBodyException
     */
    public function validate()
    {
        $requiredFields = [
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

        $emptyFields = [];
        foreach ($requiredFields as $requiredField) {
            if (is_null($this->{$requiredField})) {
                $emptyFields[] = $requiredField;
            }
        }

        if (count($emptyFields) > 0) {
            $emptyFieldsString = implode(', ', $emptyFields);

            throw new InvalidPostBodyException("Missing post body fields ({$emptyFieldsString}).");
        }
    }

    /**
     * Return post body as an array to be used to call.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'periodKey'                    => $this->periodKey,
            'vatDueSales'                  => (string) $this->vatDueSales,
            'vatDueAcquisitions'           => (string) $this->vatDueAcquisitions,
            'totalVatDue'                  => (string) $this->totalVatDue,
            'vatReclaimedCurrPeriod'       => (string) $this->vatReclaimedCurrPeriod,
            'netVatDue'                    => (string) $this->netVatDue,
            'totalValueSalesExVAT'         => (string) $this->totalValueSalesExVAT,
            'totalValuePurchasesExVAT'     => (string) $this->totalValuePurchasesExVAT,
            'totalValueGoodsSuppliedExVAT' => (string) $this->totalValueGoodsSuppliedExVAT,
            'totalAcquisitionsExVAT'       => (string) $this->totalAcquisitionsExVAT,
            'finalised'                    => $this->finalised,
        ];
    }

    /**
     * @param string $periodKey
     *
     * @return SubmitVATReturnPostBody
     */
    public function setPeriodKey(string $periodKey): self
    {
        $this->periodKey = $periodKey;

        return $this;
    }

    /**
     * @param float $vatDueSales
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatDueSales(float $vatDueSales): self
    {
        $this->vatDueSales = $vatDueSales;

        return $this;
    }

    /**
     * @param float $vatDueAcquisitions
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatDueAcquisitions(float $vatDueAcquisitions): self
    {
        $this->vatDueAcquisitions = $vatDueAcquisitions;

        return $this;
    }

    /**
     * @param float $totalVatDue
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalVatDue(float $totalVatDue): self
    {
        $this->totalVatDue = $totalVatDue;

        return $this;
    }

    /**
     * @param float $vatReclaimedCurrPeriod
     *
     * @return SubmitVATReturnPostBody
     */
    public function setVatReclaimedCurrPeriod(float $vatReclaimedCurrPeriod): self
    {
        $this->vatReclaimedCurrPeriod = $vatReclaimedCurrPeriod;

        return $this;
    }

    /**
     * @param float $netVatDue
     *
     * @return SubmitVATReturnPostBody
     */
    public function setNetVatDue(float $netVatDue): self
    {
        $this->netVatDue = $netVatDue;

        return $this;
    }

    /**
     * @param float $totalValueSalesExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValueSalesExVAT(float $totalValueSalesExVAT): self
    {
        $this->totalValueSalesExVAT = $totalValueSalesExVAT;

        return $this;
    }

    /**
     * @param float $totalValuePurchasesExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValuePurchasesExVAT(float $totalValuePurchasesExVAT): self
    {
        $this->totalValuePurchasesExVAT = $totalValuePurchasesExVAT;

        return $this;
    }

    /**
     * @param float $totalValueGoodsSuppliedExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalValueGoodsSuppliedExVAT(float $totalValueGoodsSuppliedExVAT): self
    {
        $this->totalValueGoodsSuppliedExVAT = $totalValueGoodsSuppliedExVAT;

        return $this;
    }

    /**
     * @param float $totalAcquisitionsExVAT
     *
     * @return SubmitVATReturnPostBody
     */
    public function setTotalAcquisitionsExVAT(float $totalAcquisitionsExVAT): self
    {
        $this->totalAcquisitionsExVAT = $totalAcquisitionsExVAT;

        return $this;
    }

    /**
     * @param bool $finalised
     *
     * @return SubmitVATReturnPostBody
     */
    public function setFinalised(bool $finalised): self
    {
        $this->finalised = $finalised;

        return $this;
    }
}
