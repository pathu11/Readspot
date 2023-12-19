<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .nav-container2 {
            display: flex;
            align-items: center;
            padding-left: 200px;
            padding-right: 200px;
            margin-top: 30px;
            margin-bottom: 50px;
            color: black;
            font-family: inner;
        }

        .nav-container2 a {
            margin-left: 20px;
            margin-right: 20px;
            padding: 5px;
            text-decoration: none;
            color: black;
        }

        .nav-container2 a:hover {
            background-color: #01322F;
            color: white;
            border-radius: 10px;
        }
        @media only screen and (max-width: 768px) {
            .nav-container2 {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
        </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="nav-container2">

        
        
        <a href="<?php echo URLROOT; ?>/delivery/processedorders">Processing Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/shippingorders">Shipping Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/deliveredorders">Delivered Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/returnedorders">Returned Orders</a>

        


    </div>
