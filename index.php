<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    a {
        text-decoration:none;
    }
    .busket {
        background: yellow;
    }
    #cost {
        margin-left: 2px;
        background: purple;
        color: white;
    }

    .red {
        background: red;
        color: white;
    }
</style>
<body>
    <?php
        session_start();
        $goods = [
            [
                'id' => 1,
                'Name' => 'Axe',
                'Cost' => 50,
                'Count' => '38',
            ],
            [
                'id' => 2,
                'Name' => 'Hammer',
                'Cost' => 40,
                'Count' => '58',
            ],
            [   
                'id' => 3,
                'Name' => 'Screwdriver',
                'Cost' => 10,
                'Count' => '98',
            ],
            [
                'id' => 4,
                'Name' => 'Nails',
                'Cost' => 1,
                'Count' => '800',
            ]
        ];
    ?>

    <table>
        <tbody>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Count
                </th>
            </tr>
            <?php
                if($_GET['remove'] == true) {
                    session_unset();
                } 
                if($_GET['id'] == true) {
                    $count++;
                    $_SESSION['count'] = $_SESSION['count'] + $count;
                }       
                $busket = [];
                foreach ($goods as $item): ?>
                <tr>
                    <td><?php $i++; echo "<a href ='?goods=" . $i . "&id=true" . '$idnumber='. $_SESSION['count'] . "'>" . $item["Name"] . "</a>";
                            ?></td>
                    <td><p><?= $item["Cost"] ?></td></p>
                    <td><p><?= $item["Count"] ?></td></p>
                </tr>
                
            <?php 
            if($_GET['goods'] == $i) {
                $busket = [
                    "id" => $item["id"],
                    'Name' => $item["Name"],
                    'Cost'=> $item['Cost'],
                ];
                array_push($busket, $item["Name"],$item["id"],$item['Cost']);
                $_SESSION['items'][] = $busket;
                $_SESSION['Cost'][] = $busket['Cost'];
            }
            endforeach;
            ?>
            <br>        
        </tbody>
    </table>

    <?php 
    ?>

    <table >
            
        <tbody>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    ID
                </th>
                <th>
                    Cost
                </th>
            </tr>
            <?= 
                "<a class = 'red' href ='?remove=true'> Очистить корзину </a>" . '<br>';
                if($_GET['remove'] == true) {
                session_unset();
                }  

            ?>
            <span class = "busket">Busket</span>
            <?php 
                
                if (isset($_SESSION['items'])) {
                    $length = count($_SESSION['items']);
                }
                for ($i = 0; $i < $length; $i++) { 
            ?>
                <tr class = "busket">
                
                    <td><?= $_SESSION['items'][$i][0];?></td>
                    <td><?= $_SESSION['items'][$i][1]; ?></td>
                    <td><?= $_SESSION['items'][$i][2] . "$"; ?></td>
                    <td><a href="?removeID-" class = "red">Удалить товар </a></td>
                </tr>
            <?php 
                $cost = $cost + $_SESSION['Cost'][$i]; 
                }; 
                    echo "<span id = 'cost'>" . "General cost: " . $cost . " $ </span>"; 
                 ?>
                 
        </tbody>
    </table>
</body>
</html>