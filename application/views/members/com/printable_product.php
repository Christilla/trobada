<h2><?= $title ?></h2>
<table cellSpacing="2rem" style="width: 100%; page-break-inside:auto;" autosize="1">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Description</th>
            <th>QRCode</th>
        </tr>
    </thead>
    <tbody>
        <?php $index=1; foreach($aoProducts as $Product){ //var_dump($Product); ?>
        <tr>
            <th style="text-align: center;"><?php echo $index ?></th>
            <td style="text-align: center;"><?php echo $Product->name ?></td>
            <td style="text-align: center;"><?php echo number_format(trim($Product->price, "0"), 2) ?>€</td>
            <td><?php echo htmlspecialchars($Product->description) ?></td>
            <td style="text-align: center;"><img width="100px" height="100px" src="<?php echo base_url().$Product->qrcode ?>"></td>
        </tr>
        <?php $index++; } ?>
    </tbody>
</table>