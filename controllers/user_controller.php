<?php

namespace controllers;

use brain\Controller;
use models\User;

class user_controller extends Controller
{
    public function newUser()
    {

        if (isset($_POST['first'])) {

            $params = [
                'email' => htmlspecialchars(trim($_POST['email'])),
                'subject' => htmlspecialchars(trim($_POST['subject'])),
                'firstname' => htmlspecialchars(trim($_POST['firstname'])),
                'lastname' => htmlspecialchars(trim($_POST['lastname'])),
                'mydate' => htmlspecialchars(trim($_POST['birthday'])),
                'country' => htmlspecialchars(trim($_POST['country'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
            ];
            $user = new User();

            $CheckEmail = $user->checkEmailUniq($params['email']);
            if (empty($CheckEmail)) {
                if ($user->addUser($params)) {
                    setcookie("part2", true,time()+1440);
                    session_start();
                    $_SESSION['email'] = $params['email'];
                    echo json_encode(array('data' => 'Запись создана', 'error' => false, 'email' => $_SESSION['email']));
                } else {
                    echo json_encode(array('data' => '', 'error' => true, 'errortext' => 'error'));
                }

            } else {
                echo json_encode(array('data' => '', 'error' => true, 'errortext' => 'this email is already there'));
            }


        } else {
            $countries = ["", "AALAND ISLANDS",
                "AFGHANISTAN",
                "ALBANIA",
                "ALGERIA",
                "AMERICAN SAMOA",
                "ANDORRA",
                "ANGOLA",
                "ANGUILLA",
                "ANTARCTICA",
                "ANTIGUA AND BARBUDA",
                "ARGENTINA",
                "ARMENIA",
                "ARUBA",
                "AUSTRALIA",
                "AUSTRIA",
                "AZERBAIJAN",
                "BAHAMAS",
                "BAHRAIN",
                "BANGLADESH",
                "BARBADOS",
                "BELARUS",
                "BELGIUM",
                "BELIZE",
                "BENIN",
                "BERMUDA",
                "BHUTAN",
                "BOLIVIA",
                "BOSNIA AND HERZEGOWINA",
                "BOTSWANA",
                "BOUVET ISLAND",
                "BRAZIL",
                "BRITISH INDIAN OCEAN TERRITORY",
                "BRUNEI DARUSSALAM",
                "BULGARIA",
                "BURKINA FASO",
                "BURUNDI",
                "CAMBODIA",
                "CAMEROON",
                "CANADA",
                "CAPE VERDE",
                "CAYMAN ISLANDS",
                "CENTRAL AFRICAN REPUBLIC",
                "CHAD",
                "CHILE",
                "CHINA",
                "CHRISTMAS ISLAND",
                "COLOMBIA",
                "COMOROS",
                "COOK ISLANDS",
                "COSTA RICA",
                "COTE D'IVOIRE",
                "CUBA",
                "CYPRUS",
                "CZECH REPUBLIC",
                "DENMARK",
                "DJIBOUTI",
                "DOMINICA",
                "DOMINICAN REPUBLIC",
                "ECUADOR",
                "EGYPT",
                "EL SALVADOR",
                "EQUATORIAL GUINEA",
                "ERITREA",
                "ESTONIA",
                "ETHIOPIA",
                "FAROE ISLANDS",
                "FIJI",
                "FINLAND",
                "FRANCE",
                "FRENCH GUIANA",
                "FRENCH POLYNESIA",
                "FRENCH SOUTHERN TERRITORIES",
                "GABON",
                "GAMBIA",
                "GEORGIA",
                "GERMANY",
                "GHANA",
                "GIBRALTAR",
                "GREECE",
                "GREENLAND",
                "GRENADA",
                "GUADELOUPE",
                "GUAM",
                "GUATEMALA",
                "GUINEA",
                "GUINEA-BISSAU",
                "GUYANA",
                "HAITI",
                "HEARD AND MC DONALD ISLANDS",
                "HONDURAS",
                "HONG KONG",
                "HUNGARY",
                "ICELAND",
                "INDIA",
                "INDONESIA",
                "IRAQ",
                "IRELAND",
                "ISRAEL",
                "ITALY",
                "JAMAICA",
                "JAPAN",
                "JORDAN",
                "KAZAKHSTAN",
                "KENYA",
                "KIRIBATI",
                "KUWAIT",
                "KYRGYZSTAN",
                "LAO PEOPLE'S DEMOCRATIC REPUBLIC",
                "LATVIA",
                "LEBANON",
                "LESOTHO",
                "LIBERIA",
                "LIBYAN ARAB JAMAHIRIYA",
                "LIECHTENSTEIN",
                "LITHUANIA",
                "LUXEMBOURG",
                "MACAU",
                "MADAGASCAR",
                "MALAWI",
                "MALAYSIA",
                "MALDIVES",
                "MALI",
                "MALTA",
                "MARSHALL ISLANDS",
                "MARTINIQUE",
                "MAURITANIA",
                "MAURITIUS",
                "MAYOTTE",
                "MEXICO",
                "MONACO",
                "MONGOLIA",
                "MONTSERRAT",
                "MOROCCO",
                "MOZAMBIQUE",
                "MYANMAR",
                "NAMIBIA",
                "NAURU",
                "NEPAL",
                "NETHERLANDS",
                "NETHERLANDS ANTILLES",
                "NEW CALEDONIA",
                "NEW ZEALAND",
                "NICARAGUA",
                "NIGER",
                "NIGERIA",
                "NIUE",
                "NORFOLK ISLAND",
                "NORTHERN MARIANA ISLANDS",
                "NORWAY",
                "OMAN",
                "PAKISTAN",
                "PALAU",
                "PANAMA",
                "PAPUA NEW GUINEA",
                "PARAGUAY",
                "PERU",
                "PHILIPPINES",
                "PITCAIRN",
                "POLAND",
                "PORTUGAL",
                "PUERTO RICO",
                "QATAR",
                "REUNION",
                "ROMANIA",
                "RUSSIAN FEDERATION",
                "RWANDA",
                "SAINT HELENA",
                "SAINT KITTS AND NEVIS",
                "SAINT LUCIA",
                "SAINT PIERRE AND MIQUELON",
                "SAINT VINCENT AND THE GRENADINES",
                "SAMOA",
                "SAN MARINO",
                "SAO TOME AND PRINCIPE",
                "SAUDI ARABIA",
                "SENEGAL",
                "SERBIA AND MONTENEGRO",
                "SEYCHELLES",
                "SIERRA LEONE",
                "SINGAPORE",
                "SLOVAKIA",
                "SLOVENIA",
                "SOLOMON ISLANDS",
                "SOMALIA",
                "SOUTH AFRICA",
                "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS",
                "SPAIN",
                "SRI LANKA",
                "SUDAN",
                "SURINAME",
                "SVALBARD AND JAN MAYEN ISLANDS",
                "SWAZILAND",
                "SWEDEN",
                "SWITZERLAND",
                "SYRIAN ARAB REPUBLIC",
                "TAIWAN",
                "TAJIKISTAN",
                "THAILAND",
                "TIMOR-LESTE",
                "TOGO",
                "TOKELAU",
                "TONGA",
                "TRINIDAD AND TOBAGO",
                "TUNISIA",
                "TURKEY",
                "TURKMENISTAN",
                "TURKS AND CAICOS ISLANDS",
                "TUVALU",
                "UGANDA",
                "UKRAINE",
                "UNITED ARAB EMIRATES",
                "UNITED KINGDOM",
                "UNITED STATES",
                "UNITED STATES MINOR OUTLYING ISLANDS",
                "URUGUAY",
                "UZBEKISTAN",
                "VANUATU",
                "VENEZUELA",
                "VIET NAM",
                "WALLIS AND FUTUNA ISLANDS",
                "WESTERN SAHARA",
                "YEMEN",
                "ZAMBIA",
                "ZIMBABWE",
            ];
            $params = ['links' => require_once 'config/links.php', 'countries' => $countries];
            $this->view->render('index', $params);
        }


    }

    public function updateUser()
    {
        session_start();
        if (isset($_SESSION['email'])) {
            $upload_dir = './storage/images';

            $file = $_FILES['img'];
            $filename = explode('.', $file['name']);
            $hash = md5(time() . $filename[0]) . '.' . $filename['1'];
            $file_tmp = $file['tmp_name'];
            $file_path = $upload_dir . '/' . $hash;
            $allowed = ['jpeg', 'jpg', 'png'];
            if (in_array($filename[1], $allowed)) {
                if (move_uploaded_file($file_tmp, $file_path)) {

                    $params = [
                        'company' => $_POST['company'],
                        'position' => $_POST['position'],
                        'aboutme' => $_POST['aboutme'],
                        'email' => $_SESSION['email'],
                        'photo' => $hash
                    ];
                    $user = new User();
                    if ($user->updateUser($params)) {

                        echo json_encode(['data' => 'запись обновлена', 'error' => false]);
                        setcookie("part2", false, time() - 1440);
                        session_destroy();
                    } else {
                        setcookie("part2", false, time() - 1440);
                        session_destroy();
                        echo json_encode(['errortext' => 'непредвиденная ошибка попробуйте заново нажмите f5 ', 'error' => true]);
                    }
                } else {
                    echo json_encode(['data' => 'запись НЕ обновлена ', 'file' => $file, 'error' => true]);
                }
            } else {
                echo json_encode(['errortext' => 'расширение файла не правильное', 'file' => $file, 'error' => true]);
            }
        } else {
            setcookie("part2", false, time() - 1440);
            echo json_encode(['errortext' => 'не найдена запись для обновления пройдите регистрацию сначала нажав f5', 'error' => true]);
        }


    }

    public function showUsers()
    {

        $user = new User();
        $users = $user->selectAll();
        $this->view->render('users', ['users' => $users]);
    }

}