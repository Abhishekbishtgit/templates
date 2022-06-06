<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use frontend\modules\walmartcanada\components\Polaris;
use frontend\modules\walmartcanada\widgets\grid\GridView;
use frontend\modules\walmartcanada\components\MerchantHelper;
use frontend\modules\walmartcanada\components\Order\OrderHelper;
use frontend\modules\walmartcanada\components\Queries\Order\Order;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\walmartcanada\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;

$errorOrder = \yii\helpers\Url::toRoute(['order/viewerror']);
$refundOrder = \yii\helpers\Url::toRoute(['order/refund-data']);
$cancelOrder = \yii\helpers\Url::toRoute(['order/cancel-order']);

$filterParams = Yii::$app->request->queryParams;
$filters = isset($filterParams['OrderSearch']) ? $filterParams['OrderSearch'] : ['order_status' => 'all'];
$merchant_id = Yii::$app->user->identity->merchant_id;

$jump_pageInputId = 'pager-custompage';

/*********select all orders html**********/
$selectAllHtml = '';

$totalOrders = $dataProvider->getTotalCount();
$perPage = $dataProvider->pagination->pageSize;

if ($totalOrders > $perPage) {
    $totalOrders = $perPage;
}

$merchantHelperObject = new MerchantHelper();
$merchantObject = $merchantHelperObject->getMerchantObject($merchant_id);
$get_order_limit = $merchantObject->getConfig()->getData('order_limit');

if($get_order_limit != 'not-set') {
    $orderQueryRunner = new Order();
    $alreadyFetchedOrders = $orderQueryRunner->getTotalOrderCountPerMonth($merchant_id);
    $remainingorder=$get_order_limit-$alreadyFetchedOrders;
    if($remainingorder < 10) {
        //$message = "Your order fetch limit " . $get_order_limit . " Orders out of ". $alreadyFetchedOrders ." Ordets limit is exhausted, kindly  <a  href='" . Url::toRoute(['payment/index']) . "'>upgrade your plan</a> to fetch new Orders.";
        if($alreadyFetchedOrders>$get_order_limit) { 
            $message="Your order limit has exhaust , Kindly  <a  href='" . Url::toRoute(['payment/index']) . "'>upgrade your plan</a> to fetch new Orders.";
        } else {
            $message="Your order limit is about to exhaust (".$alreadyFetchedOrders."/".$get_order_limit."), Kindly  <a  href='" . Url::toRoute(['payment/index']) . "'>upgrade your plan</a> to fetch new Orders.";
        }
        echo Polaris::Notification('info', ['wrapper_class' => 'pt-15 ', 'message' => 'Alert :: ' . $message]);
    }
}

$header = [
    'heading' => $this->title,
    'secondary_actions' => [
        'menus' => [
            [
                'label' => 'Fetch orders',
                'tag' => 'a',
                'svg' => Polaris::Svg('import'),
                'options' => [
                    'href' => Url::toRoute(['order/fetch']),
                    'title' => 'Fetch orders from Walmart Canada',
                    'data-toggle'=>'tooltip'
                ],
            ],
            [
                'label' => 'Fetch Acknowledged orders',
                'tag' => 'a',
                'svg' => Polaris::Svg('import'),
                'options' => [
                    'href' => Url::toRoute(['order/fetch?status=Acknowledged']),
                    'title' => 'Fetch Acknowledged orders from Walmart Canada',
                    'data-toggle'=>'tooltip'
                ],
            ],
            [
                'label' => 'Ship orders',
                'tag' => 'a',
                'svg' => Polaris::Svg('ship'),
                'options' => [
                    'href' => Url::toRoute(['order/batch-order-ship']),
                    'title' => 'Ship orders on Walmart Canada',
                    'data-toggle'=>'tooltip'
                ],
            ]
        ],
        'menu_group' => [
            [
                'label' => 'Update Order Status',
                'tag' => 'a',
                'svg' => Polaris::Svg('sync'),
                'options' => [
                    'onclick' => 'updatestatus()',
                    'title' => 'Update order status',
                    'data-toggle' => 'tooltip',
                ],
            ],
        ]
    ],
];
if($merchant_id != 6140) {
    unset($header['secondary_actions']['menus']['1']);
}
$this->pageHeader = $header;

if($totalOrders == 0 && !isset($filterParams['OrderSearch']))
{
    $title = "Managing your Walmart Canada orders just got easier!";
    $follow_step = [
            'Click on <a href="'.Yii::getAlias('@webwalmartcaurl/order/fetch').'">Fetch Order(s)</a> to pull your Walmart Canada orders and create on your shopify store',
            'Click on <a href="'.Yii::getAlias('@webwalmartcaurl/order/batch-order-ship').'">Ship Orders</a> to update all fulfilled orders from your shopify store to Walmart Canada',
            'View order details such as order purchase order id, order status, date and time of order created on Walmart Canada',
            'Your orders can have one  of the following order status- COMPLETED, READY, ACKNOWLEDGED, CANCELLED and FAILED.',
            'See the reason for order failure & rectify it.'
    ];
    echo $this->render('../layouts/video_help',['src'=> '','follow_step'=>$follow_step,'title'=>$title]);
}
else
{  ?>
    <!-- page Header end -->
    <?php Pjax::begin(['timeout' => 10000]); ?>
    <div class="Polaris-Page__Content">
        <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
                <ul class="nav nav-tabs" id="filter_tab_view">
                    <?php
                    $orderHelpderObj = new OrderHelper();
                    $toolTip = $orderHelpderObj->getOrderStatusTooltip();

                    if(is_array($tab_filters) && count($tab_filters)){
                        $i = 0;
                        $html = '';
                        foreach ($tab_filters as $key=>$tab)
                        {
                            $class = 'tab-view-listing';
                            if(isset($filters['order_status']) && $filters['order_status']==$key) {
                                $class .= ' active';
                            }
                            $html.='
                            <li class="'.$class.'" id="tab-view-listing-'.$key.'">
                                <a data-toggle="tab" href="#sales_order_tab" data-toggle-tooltip="tooltip" title = "'.$toolTip[$key].'" onclick=\'changeTabView(this,"'.$key.'")\'>'.$tab.'</a>
                            </li>';
                            $i++;
                        }
                        echo $html;
                    }
                    ?>
                    <input type="hidden" id="walmartcanada-order-status" name="OrderSearch[order_status]" value="">
                    <input type="hidden" id="walmartcanada-tab-filter-status" value="<?= isset($filters['status'])?$filters['status']:'' ?>">
                </ul>
                <div class="Polaris-ResourceList__FiltersWrapper Polaris-filter-wrap pl-0 pr-0">
                    <div class="Polaris-FormLayout">
                        <div class="Polaris-FormLayout__Item">
                            <div class="Polaris-Labelled--hidden">
                               
                                <?= $this->render('filters', ['model' => $searchModel]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-contetab_filtersnt py-15">
                    <div id="sales_order_tab" class="tab-pane fade in active">
                        <?= $gridView = GridView::widget([
                            'id' => 'walmartcanada-order',
                            'options' => ['class' => 'custom-polaris-grid grid-view'],
                            'dataProvider' => $dataProvider,
                            'emptyText' => '<div class="empty-grid-options">
                                                <img src="'.Yii::getAlias('@webwalmartcabasepath').'/assets/images/search.png" alt="empty-search">
                                                <p class="mt-15 Polaris-DisplayText Polaris-DisplayText--sizeSmall">Oops! Found Nothing</p>
                                                <span class="Polaris-TextStyle--variationSubdued">Try changing the filters or search term</span>
                                            </div>',
                            'floatHeader' => true,
                            'floatOverflowContainer' => true,
                            'filterSelector' => "select[name='" . $dataProvider->getPagination()->pageSizeParam . "'],input[name='" . $dataProvider->getPagination()->pageParam . "'], #main-listing-filter, #walmartcanada-order-status",
                            'customResetFilterData' => ['selector' => '#reset-filter,#reset-filter-outer', 'formSelector' => '#main-listing-filter', 'singleResetSelector' => '.single-reset'],
                            'filterContainerSelector' => '#order_listing-filters',//pass the selector that will be hide when filtering is completed
                            'customFilterEventAndSelector' => '{"click": "#apply-filter,#apply-full-text-filter,#walmartcanada-order-status", "keydown.yiiGridView": "#main-listing-filter,#'.$jump_pageInputId.'"}',
                            'pageSizeSelector' => '#pager-pagesize',
                            'mainFilterParamIndex' => 'OrderSearch',

                            'pager' => [
                                'class' => \frontend\modules\walmartcanada\widgets\LinkPager::className(),
                                'pageSizeList' => ['25' => '25', '50' => '50', '100' => '100'],
                                'pageSizeOptions' => ['class' => 'form-control', 'id' => 'pager-pagesize', 'style' => 'width:auto;margin-top:0px;'],
                                'customPageOptions' => ['class' => 'form-control', 'id' => $jump_pageInputId, 'style' => 'width:auto;margin-top:0px;'],
                                'template' => '{pageSize} <label for="pager-pagesize"> per page</label> {customPage}',
                            ],
                            'pjax' => false,
                            'striped' => false,
                            'hover' => true,
                            'panelTemplate' => '<div class="{prefix}{type}">{panelHeading}{panelBefore}{items}{panelAfter}{panelFooter}</div>',
                            'panelHeadingTemplate' => '<div class="bulk-action-wrap" style="display:none;"><div class="selection-message">' . Polaris::Checkbox('selection_all', ['wrapper_class' => 'Custom-polaris-checkbox', 'id' => 'selectall-checkbox', 'onclick' => "selectAllCheckboxes(this)", 'value' => "1", 'class' => "select-on-check-all kv-align-left kv-align-middle"]) . '<span class="order-count">0</span>&nbsp;orders selected
                            </span></div><div class="actions-bulk">{title}</div>' . $selectAllHtml . '
                            </div><div class="kv-panel-pager Polaris-resource-left">{pager}</div><div class="Polaris-resource-right">{summary}</div>',
                            'panel' => ['type' => GridView::TYPE_PRIMARY,'footer' => false, 'after' => false, 'before' => false],
                            'columns' => [
                                [
                                    'label' => 'Purchase Order Id',
                                    'contentOptions' => ['style' => 'width: 250px;'],
                                    'sortLinkOptions' => ['class' => 'sortable'],
                                    'attribute' => 'purchase_order_id',
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'value' => function ($data) {
                                        return Html::a($data->purchase_order_id, Url::toRoute(['order/vieworderdetails','purchase_order_id'=>$data->purchase_order_id,'shopify_order_id'=>$data['shopify_order_id']]), ['data-pjax'=>0]);
                                    }
                                ],
                                [
                                    'label' => 'Order Name (Shopify)',
                                    'attribute' => 'shopify_order_name',
                                    'sortLinkOptions' => ['class' => 'sortable'],
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'value' => function($model){
                                        if (!empty($model->shopify_order_name)){
                                            return Html::a($model->shopify_order_name.'<span>'. Polaris::svg("external-link").'</span>', 'https://'.  Yii::$app->user->identity->shopurl .'/admin/orders/'.$model['shopify_order_id'],['data-pjax'=>0,'target'=>'_blank']);
                                        }
                                    }
                                ],
                                [
                                    'label' => 'Order Sku',
                                    'attribute' => 'order_sku',
                                    'sortLinkOptions' => ['class' => 'sortable'],
                                    'format' => 'raw',
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'value' => function($model){
                                        return $model->order_sku;
                                    }
                                ],
                                [
                                    'label' => 'created at',
                                    'attribute' => 'created_at',
                                    'sortLinkOptions' => ['class' => 'sortable'],
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'value' => function ($data) {
                                        if(Yii::$app->user->identity->merchant_id == 32342) {
                                            $timestamp = strtotime($data['created_at']);
                                            $date = new DateTime();
                                            $date->setTimestamp($timestamp);
                                            $date->setTimezone(new \DateTimeZone('PST'));
                                            $createdAtDate = $date->format('Y-m-d H:i:s') . "\n";
                                            return date('F j, Y, g:i A', strtotime($createdAtDate));
                                        } else {
                                            return date('F j, Y, g:i A', strtotime($data['created_at']));
                                        }
                                    }
                                ],
                                [
                                    'label' => 'status',
                                    'attribute' => 'order_status',
                                    'sortLinkOptions' => ['class' => 'sortable'],
                                    'hAlign' => 'center',
                                    'vAlign' => 'middle',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                    $orderHelper = new OrderHelper();
                                        
                                    $html= "<span class='Polaris-Badge Polaris-Badge--status'>". $orderHelper->getStatusLabel($data['order_status']) ."</span><br>";
                                    return $html;
                                    },
                                    'contentOptions' => ['style' => 'width: 250px;'],
                                    'filter' => [
                                        OrderHelper::READY_ORDERS => OrderHelper::READY_ORDERS,
                                        OrderHelper::COMPLETED_ORDERS => OrderHelper::COMPLETED_ORDERS,
                                        OrderHelper::ACKNOWLEDGED_ORDERS => OrderHelper::ACKNOWLEDGED_ORDERS,
                                        OrderHelper::CANCELLED_ORDERS => OrderHelper::CANCELLED_ORDERS,
                                        OrderHelper::REFUNDED_ORDERS => OrderHelper::REFUNDED_ORDERS,
                                    ],
                                ],
                                [
                                    'class' => 'kartik\grid\ActionColumn',
                                    'header' => 'ACTIONS',
                                    'headerOptions' => ['style' => 'color:#337ab7'],
                                    'template' => '<div class="Polaris-ButtonGroup  Polaris-ButtonGroup--segmented" >{error}{cancel}{refund}</div>',
                                    'buttons' => [
                                        'error' => function ($url, $model) {
                                            if ($model['fetch_status'] == 0) {
                                                $options = ['data-pjax' => 0, 'onclick' => 'return checkError("' . $model['purchase_order_id'] . '")', 'title' => 'error', 'class' => 'Polaris-Button Polaris-Button--iconOnly'];
                                                $html = '<div class="Polaris-ButtonGroup__Item">';
                                                $html .=   Html::a(' <span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Icon"><span class="Polaris-Icon">'.Polaris::Svg('error').'</span></span>
                                                            </span>',
                                                    'javascript:void(0)', $options);
                                                $html .= "</div>";
                                                return $html;
                                            }
                                        },
                                        'cancel' => function ($url, $model) {
                                            if (!in_array($model['order_status'], [OrderHelper::CANCELLED_ORDERS, OrderHelper::COMPLETED_ORDERS,OrderHelper::REFUNDED_ORDERS])) {
                                                $options = ['data-pjax' => 0, 'onclick' => 'return cancelOrderModal("' . $model['purchase_order_id'] . '")', 'title' => 'Cancel order from walmart', 'class' => 'Polaris-Button Polaris-Button--iconOnly'];
                                                $html = '<div class="Polaris-ButtonGroup__Item">';
                                                $html .=   Html::a('<span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Icon"><span class="Polaris-Icon">'.Polaris::Svg('cancel').'</span></span>
                                                            </span>',
                                                    'javascript:void(0)', $options);
                                                $html .= "</div>";
                                                return $html;
                                            }
                                        },
                                        'refund' => function ($url, $model) {
                                            if( $model['order_status'] == OrderHelper::COMPLETED_ORDERS && $model->order_status !=OrderHelper::REFUNDED_ORDERS && $model->order_status!=OrderHelper::CANCELLED_ORDERS){
                                                $options = ['data-pjax' => 0, 'onclick' => 'return openRefundPopup("' . $model['purchase_order_id'] . '")', 'title' => 'order refund', 'class' => 'Polaris-Button Polaris-Button--iconOnly'];
                                                $html = '<div class="Polaris-ButtonGroup__Item">';
                                                $html .=   Html::a(' <span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Icon"><span class="Polaris-Icon">'.Polaris::Svg('refund').'</span></span>
                                                            </span>',
                                                    'javascript:void(0)', $options);
                                                $html .= "</div>";
                                                return $html;
                                            }
                                        },
                                    ]
                                ]
                            ],
                        ]); ?>
                        <script type="text/javascript">
                            $('.summary').unwrap();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
<?php
}?>
<div id='view_error_modal'></div>
<div id='confirm-div'></div>
<div id='cancel_order_modal'></div>
<div id='refund_order_modal'></div>
<?=Html::tag('div','',['id'=>'popup-div','style'=>'display:none'])?>

<!-- Order update Status Modal starts -->

<?= $this->render('update-status-modal'); ?>

<!-- Order update Status Modal ends -->


<script type="text/javascript">

    /*tab filter by status**/
    function changeTabView(node,status)
    {
        if(status)
        {
            $('#walmartcanada-order-status').val(status);
            $('#walmartcanada-order-status').click();
            $('#reset-filter-outer').click();
        }
    }

    function cancelOrderModal(purchase_order_id) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var url = '<?= $cancelOrder; ?>';
        $('#LoadingMSG').show();
        $.ajax({
            method: "post",
            url: url,
            data: {purchase_order_id: purchase_order_id, _csrf: csrfToken}
        })
            .done(function (msg) {
                $('#LoadingMSG').hide();
                $('#cancel_order_modal').html(msg);
                $('#cancel_order_modal').show();
            })
    }

    function checkError(id)
    {
        var url = '<?= $errorOrder ?>';
        $('#LoadingMSG').show();
        $.ajax({
            method: "post",
            url: url,
            data: {purchase_order_id: id}
        })
            .done(function (msg) {
                $('#LoadingMSG').hide();
                $('#view_error_modal').html(msg);
                $('#view_error_modal').show();
            })
    }

    function openRefundPopup($id) {

        var url = '<?= $refundOrder ?>';
        $('#LoadingMSG').show();
        $.ajax({
            method: "post",
            url: url,
            data: {id: $id}
        })
            .done(function (msg) {
               $('#LoadingMSG').hide();
               $('#refund_order_modal').html(msg);
               $('#refund_order_modal').show();
            })
    }
</script>