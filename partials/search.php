<div class="search-container"><div class="search-container-inner"><h1 ng-if="q.$"><i class="glyphicon glyphicon-search"></i> &nbsp;customers</h1><input type="search" ng-model="q.$" value="" placeholder="start typing..." ng-style="q.$ &amp;&amp; {'margin-top': '3%'} || !q.$ &amp;&amp; {'margin-top': '25%'}" autofocus="autofocus" class="search form-control"/><div ng-show="q.$" class="row center shrunk"><label>Show&nbsp;</label><select ng-model="quantity" class="form-control tenth center"><option>5</option><option>10</option><option>25</option><option selected="selected">50</option><option>75</option><option>100</option><option>150</option><option>200</option><option>300</option><option>400</option><option>500</option><option>1000</option></select></div><div class="row"><table ng-if="q.$" class="table table-hover table-condensed three-fourths center"><thead><tr><th>#</th><th>Customer Name</th><th>Contact</th><th>Address</th><th>City</th><th>State</th><th>Code</th><th>Country</th><th></th></tr></thead><tbody><tr ng-repeat="client in clients | filter:q:strict | limitTo:quantity" popover="Assigned to the {{client.o_city || 'Boston'}} office." popover-popup-delay="1000" popover-trigger="mouseenter"><td ng-if="client.customerNumber.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.customerNumber}}</td><td ng-if="client.customerNumber.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.customerNumber}}</td><td ng-if="!client.customerNumber"></td><td ng-if="client.customerName.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.customerName}}</td><td ng-if="client.customerName.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.customerName}}</td><td ng-if="client.contactLastName.toLowerCase().indexOf(q.$.toLowerCase()) != -1 || client.contactFirstName.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success"><span ng-if="client.contactLastName &amp;&amp; client.contactFirstName">{{client.contactLastName}},&nbsp;</span><span ng-if="client.contactLastName &amp;&amp; !client.contactFirstName">{{client.contactLastName}}</span><span ng-if="client.contactFirstName">{{client.contactFirstName}}</span></td><td ng-if="client.contactLastName.toLowerCase().indexOf(q.$.toLowerCase()) == -1 &amp;&amp; client.contactFirstName.toLowerCase().indexOf(q.$.toLowerCase()) == -1"><span ng-if="client.contactLastName &amp;&amp; client.contactFirstName">{{client.contactLastName}},&nbsp;</span><span ng-if="client.contactLastName &amp;&amp; !client.contactFirstName">{{client.contactLastName}}</span><span ng-if="client.contactFirstName">{{client.contactFirstName}}</span></td><td ng-if="client.addressLine1.toLowerCase().indexOf(q.$.toLowerCase()) != -1 || client.addressLine2.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success"> <p>{{client.addressLine1}}</p><p ng-if="client.addressLine2">{{client.addressLine2}}</p></td><td ng-if="client.addressLine1.toLowerCase().indexOf(q.$.toLowerCase()) == -1 &amp;&amp; client.addressLine2.toLowerCase().indexOf(q.$.toLowerCase()) == -1"> <p>{{client.addressLine1}}</p><p ng-if="client.addressLine2">{{client.addressLine2}}</p></td><td ng-if="client.city.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.city}}</td><td ng-if="client.city.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.city}}</td><td ng-if="client.state &amp;&amp; client.state.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.state}} suc</td><td ng-if="client.state &amp;&amp; client.state.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.state}}</td><td ng-if="!client.state">&nbsp;</td><td ng-if="client.postalCode.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.postalCode}}</td><td ng-if="client.postalCode.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.postalCode}}</td><td ng-if="client.country.toLowerCase().indexOf(q.$.toLowerCase()) != -1" class="success">{{client.country}}</td><td ng-if="client.country.toLowerCase().indexOf(q.$.toLowerCase()) == -1">{{client.country}}</td><td><div ng-controller="clientDetailsModalController"><button ng-click="open(client)" ng-if="client.creditLimit &gt; 0 &amp;&amp; !client.warning" tooltip="Click for detailed information about {{client.customerName}}'s account." tooltip-placement="left" class="btn btn-primary">View</button><button ng-click="open(client)" ng-if="client.creditLimit == 0 || client.warning" popover="This account has outsanding issues." popover-placement="bottom" popover-trigger="mouseenter" class="btn btn-warning">View</button><script type="text/ng-template" id="myModalContent.html"><div class="modal-header"><h2><i class="glyphicon glyphicon-th"></i> {{client.customerName}}</h2><p ng-if="client.warning" ng-repeat="message in client.messages" class="center shrunk"><em>{{message}}</em></p></div><div class="modal-body"><div class="row"><div ng-if="client.creditLimit &gt; 0" class="col-md-2"><i class="glyphicon glyphicon-usd"></i> Credit Limit</div><div ng-if="client.creditLimit == 0" class="col-md-2 bg-danger"><em><i class="glyphicon glyphicon-warning-sign"></i> Credit Limit</em></div><div ng-if="client.creditLimit &gt; 0" class="col-md-2">${{client.creditLimit}}</div><div ng-if="client.creditLimit == 0" popover="This client has no credit!" popover-placement="left" popover-title="Warning" popover-trigger="mouseenter" class="col-md-10 bg-danger"><em>${{client.creditLimit}}</em></div></div><div class="row"><div class="col-md-2"><i class="glyphicon glyphicon-briefcase"></i> Sales Rep.</div><div ng-if="client.salesRepEmployeeNumber" class="col-md-10"><div class="row"><div class="col-md-12">{{client.em_firstName}} {{client.em_lastName}} (&#35;{{client.salesRepEmployeeNumber}}) <i class="glyphicon glyphicon-envelope"></i> <a href="mailto:{{client.em_email}}">{{client.em_email}}</a></div></div></div><div ng-if="!client.salesRepEmployeeNumber" class="col-md-10">No representative assigned.</div></div><div class="row"><div class="col-md-2"><i class="glyphicon glyphicon-user"></i> Contact</div><div class="col-md-10">{{client.contactFirstName}} {{client.contactLastName}}</div></div><div class="row"><div class="col-md-2"><i class="glyphicon glyphicon-phone"></i> Phone</div><div class="col-md-10">{{client.phone}}&nbsp;<span ng-if="client.country">({{client.country}})</span></div></div><hr/><tabset><tab heading="Payment History"><h4 class="center no-padding"><i class="glyphicon glyphicon-list"></i> Payment History</h4><table class="table table-striped table-hover table-condensed center three-fourths"><thead><tr><th>Check #</th><th>Date</th><th>Amount</th></tr></thead><tbody><tr ng-repeat="payment in client.p_checks track by $index"><td>{{client.p_checks[$index]}}</td><td>{{client.p_dates[$index]}}</td><td ng-if="client.p_amounts[$index] &gt; 50000" class="success">${{client.p_amounts[$index]}}</td><td ng-if="client.p_amounts[$index] &gt; 2000 &amp;&amp; client.p_amounts[$index] &lt;= 50000">${{client.p_amounts[$index]}}</td><td ng-if="client.p_amounts[$index] &lt; 2000" class="danger">${{client.p_amounts[$index]}}</td></tr></tbody></table></tab><tab heading="Order History"><h4 class="center no-padding"><i class="glyphicon glyphicon-list"></i> Order History</h4><table class="table table-striped table-hover table-condensed center three-fourths"><thead><tr><th>Order #</th><th>Placed On</th><th>Due On</th><th>Shipped On</th><th>Status</th></tr></thead><tbody><tr ng-repeat="order in client.o_orders track by $index"><td>{{client.o_orders[$index]}}</td><td>{{client.o_orderDates[$index]}}</td><td>{{client.o_requiredDates[$index]}}</td><td>{{client.o_shippedDates[$index] || "Not shipped."}}</td><td ng-if="client.o_statuses[$index] == 'Shipped'" class="success">{{client.o_statuses[$index]}}</td><td ng-if="client.o_statuses[$index] == 'Cancelled'" class="danger">{{client.o_statuses[$index]}}</td><td ng-if="client.o_statuses[$index] != 'Cancelled' &amp;&amp; client.o_statuses[$index] != 'Shipped'" class="warning">{{client.o_statuses[$index]}}</td></tr></tbody></table></tab></tabset></div><div class="modal-footer"><button ng-click="ok()" class="btn btn-primary">OK</button></div></script></div></td></tr></tbody></table></div></div></div>