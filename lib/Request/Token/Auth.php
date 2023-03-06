<?php

namespace Payments;

class RequestTokenAuth extends RequestToken {
	
	protected $_params = array(
		// Security Data
        "merchantId" => array("type" => "mandatory"),
        "password" => array("type" => "mandatory"),
		// Transaction Data
		"action" => array("type" => "mandatory"),
		"firstTimeTransaction" => array("type" => "optional"),
		"timestamp" => array("type" => "mandatory"),
		"merchantChallengeInd" => array("type" => "optional"),
		"merchantDecReqInd" => array("type" => "optional"),
		"merchantDecMaxTime" => array("type" => "optional"),
		"channel" => array("type" => "mandatory"),
		"country" => array("type" => "mandatory"),
		"allowOriginUrl" => array("type" => "mandatory"),
		"merchantNotificationUrl" => array("type" => "mandatory"),
		"merchantLandingPageUrl" => array("type" => "optional"),
		"merchantLandingPageRedirectMethod" => array("type" => "optional"),
		// External Authentication
		"externalAuthentication" => array("type" => "optional"),
		// Payment Method Data
		"paymentSolutionId" => array("type" => "optional"),
		"specinCreditCardToken" => array("type" => "optional"),
		"specinProcessWithoutCvv2" => array("type" => "optional"),
		"forceSecurePayment" => array("type" => "optional"),
		"processUnknownSecurePayment" => array("type" => "optional"),
		// Merchant Transaction Data
		"merchantTxId" => array("type" => "optional"),
		"operatorId" => array("type" => "optional"),
		"brandId" => array("type" => "optional"),
		"bankMid" => array("type" => "optional"),
		"limitMin" => array("type" => "optional"),
		"limitMax" => array("type" => "optional"),
		"freeText" => array("type" => "optional"),
		"customParam1_OR" => array("type" => "optional"),
		"customParam2_OR" => array("type" => "optional"),
		"customParam3_OR" => array("type" => "optional"),
		"customParam4_OR" => array("type" => "optional"),
		"customParam5_OR" => array("type" => "optional"),
		"customParam6_OR" => array("type" => "optional"),
		"customParam7_OR" => array("type" => "optional"),
		"customParam8_OR" => array("type" => "optional"),
		"customParam9_OR" => array("type" => "optional"),
		"customParam10_OR" => array("type" => "optional"),
		"customParam11_OR" => array("type" => "optional"),
		"customParam12_OR" => array("type" => "optional"),
		"customParam13_OR" => array("type" => "optional"),
		"customParam14_OR" => array("type" => "optional"),
		"customParam15_OR" => array("type" => "optional"),
		"customParam16_OR" => array("type" => "optional"),
		"customParam17_OR" => array("type" => "optional"),
		"customParam18_OR" => array("type" => "optional"),
		"customParam19_OR" => array("type" => "optional"),
		"customParam20_OR" => array("type" => "optional"),
		"s_text1" => array("type" => "optional"),
		"s_text2" => array("type" => "optional"),
		"s_text3" => array("type" => "optional"),
		"s_text4" => array("type" => "optional"),
		"s_text5" => array("type" => "optional"),
		"d_date1" => array("type" => "optional"),
		"d_date2" => array("type" => "optional"),
		"d_date3" => array("type" => "optional"),
		"d_date4" => array("type" => "optional"),
		"d_date5" => array("type" => "optional"),
		"b_bool1" => array("type" => "optional"),
		"b_bool2" => array("type" => "optional"),
		"b_bool3" => array("type" => "optional"),
		"b_bool4" => array("type" => "optional"),
		"b_bool5" => array("type" => "optional"),
		"n_num1" => array("type" => "optional"),
		"n_num2" => array("type" => "optional"),
		"n_num3" => array("type" => "optional"),
		"n_num4" => array("type" => "optional"),
		"n_num5" => array("type" => "optional"),
		"virtualAccountNumber" => array("type" => "optional"),
		// Customer Browser/App/Device Data
		"userDevice" => array("type" => "optional"),
		"userAgent" => array("type" => "optional"),
		"customerIPAddress" => array("type" => "optional"),
		"customerBrowser" => array("type" => "optional"),
		"sdkAppInfo" => array("type" => "optional"),
		"language" => array("type" => "optional"),
		// Transaction Amount Data
		"amount" => array("type" => "optional"),
		"currency" => array("type" => "mandatory"),
		"taxAmount" => array("type" => "optional"),
		"shippingAmount" => array("type" => "optional"),
		"chargeAmount" => array("type" => "optional"),
		"discountAmount" => array("type" => "optional"),
		// Customer Personal Data
		"customerFirstName" => array("type" => "optional"),
		"customerLastName" => array("type" => "optional"),
		"customerSex" => array("type" => "optional"),
		"customerDateOfBirth" => array("type" => "optional"),
		"customerEmail" => array("type" => "optional"),
		"customerPhone" => array("type" => "optional"),
		"customerDocumentType" => array("type" => "optional"),
		"customerDocumentNumber" => array(
			"type" => "conditional",
			"mandatory" => array("customerDocumentType" => "isset"),
		),
		"customerDocumentState" => array("type" => "optional"),
		// Payer Data
		"payerFirstName" => array("type" => "optional"),
		"payerLastName" => array("type" => "optional"),
		"payerEmail" => array("type" => "optional"),
		"payerDateOfBirth" => array("type" => "optional"),
		"payerPhone" => array("type" => "optional"),
		"payerDocumentType" => array("type" => "optional"),
		"payerDocumentNumber" => array(
			"type" => "conditional",
			"mandatory" => array("payerDocumentType" => "isset"),
		),
		"payerCustomerId" => array("type" => "optional"),
		// Customer Account Data with the Merchant
		"customerId" => array("type" => "optional"),
		"merchantReference" => array("type" => "optional"),
		"customerRegistrationDate" => array("type" => "optional"),
		"customerAccountInfo" => array("type" => "optional"),
		// Customer Address Data
		"customerAddressHouseName" => array("type" => "optional"),
		"customerAddressHouseNumber" => array("type" => "optional"),
		"customerAddressFlat" => array("type" => "optional"),
		"customerAddressStreet" => array("type" => "optional"),
		"customerAddressCity" => array("type" => "optional"),
		"customerAddressDistrict" => array("type" => "optional"),
		"customerAddressPostalCode" => array("type" => "optional"),
		"customerAddressCountry" => array("type" => "optional"),
		"customerAddressState" => array("type" => "optional"),
		"customerAddressPhone" => array("type" => "optional"),
		"customerBillingAddressHouseName" => array("type" => "optional"),
		"customerBillingAddressHouseNumber" => array("type" => "optional"),
		"customerBillingAddressFlat" => array("type" => "optional"),
		"customerBillingAddressStreet" => array("type" => "optional"),
		"customerBillingAddressCity" => array("type" => "optional"),
		"customerBillingAddressDistrict" => array("type" => "optional"),
		"customerBillingAddressPostalCode" => array("type" => "optional"),
		"customerBillingAddressCountry" => array("type" => "optional"),
		"customerBillingAddressState" => array("type" => "optional"),
		"customerBillingAddressPhone" => array("type" => "optional"),
		"customerShippingAddressHouseName" => array("type" => "optional"),
		"customerShippingAddressHouseNumber" => array("type" => "optional"),
		"customerShippingAddressFlat" => array("type" => "optional"),
		"customerShippingAddressStreet" => array("type" => "optional"),
		"customerShippingAddressCity" => array("type" => "optional"),
		"customerShippingAddressDistrict" => array("type" => "optional"),
		"customerShippingAddressPostalCode" => array("type" => "optional"),
		"customerShippingAddressCountry" => array("type" => "optional"),
		"customerShippingAddressState" => array("type" => "optional"),
		"customerShippingAddressPhone" => array("type" => "optional"),
		// Additional Authentication Data
		"merchantAuthInfo" => array("type" => "optional"),
		"merchantPriorAuthInfo" => array("type" => "optional"),
		"merchantRiskIndicator" => array("type" => "optional"),
		// Card On File Transactions Required Parameters
		"cardOnFileType" => array("type" => "optional"),
		"cardOnFileInitiator" => array(
			"type" => "conditional",
			"mandatory" => array("cardOnFileType" => "Repeat"),
		),
		"cardOnFileInitialTransactionId" => array(
			"type" => "conditional",
			"mandatory" => array("cardOnFileType" => "Repeat"),
		),
		"cardOnFileReason" => array(
			"type" => "conditional",
			"mandatory" => array("cardOnFileType" => "isset"),
		),
		"cardOnFileMaxPayments" => array(
			"type" => "conditional",
			"mandatory" => array("cardOnFileReason" => "I"),
		),
		// Merchant Managed Recurring Payment Plan Required Parameters
		"mmrpBillPayment" => array("type" => "optional"),
		"mmrpCustomerPresent" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "isset"),
		),
		"mmrpOriginalMerchantTransactionId" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "Recurring"),
		),
		"mmrpContractNumber" => array("type" => "optional"),
		"mmrpRecurringExpiry" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "Recurring"),
		),
		"mmrpRecurringFrequency" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "Recurring"),
		),
		"mmrpCurrentTotalNumberOfInstallments" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "RecurringInstallment"),
		),
		"mmrpCurrentInstallmentNumber" => array(
			"type" => "conditional",
			"mandatory" => array("mmrpBillPayment" => "RecurringInstallment"),
		),
		// EVO Gateway Recurring Payment Plan Setup Required Parameters
		"rpPlanType" => array("type" => "optional"),
		"rpPlanName" => array("type" => "optional"),
		"rpFrequency" => array("type" => "optional"),
		"rpNoOfPayments" => array("type" => "optional"),
		"rpDueDay" => array("type" => "optional"),
		"rpNextPaymentDate" => array("type" => "optional"),
		"rpAmount" => array("type" => "optional"),
		"rpFinalAmount" => array("type" => "optional"),
		"rpContractNumber" => array("type" => "optional"),
		"rpReceiptRequired" => array("type" => "optional"),
		"rpReceiptEmail" => array(
			"type" => "conditional",
			"mandatory" => array("rpReceiptRequired" => "1"),
		),
		"rpCardUpdaterInterval" => array("type" => "optional"),
		// Merchant Managed eGlobal Instalments Parameters
		"mmipPlanID" => array("type" => "optional"),
		"mmipIssuerName" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipPlanName" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipStartDate" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipEndDate" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipCurrency" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipMinimumAmount" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		"mmipNoOfPayments" => array(
			"type" => "conditional",
			"mandatory" => array("mmipPlanID" => "isset"),
		),
		// EVO Gateway Managed eGlobal Instalments Parameter
		"selectedInstallmentsPlanId" => array("type" => "optional"),
    );

    public function __construct() {
        parent::__construct();
        $this->_data["action"] = Payments::ACTION_AUTH;
    }

}
