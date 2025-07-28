<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'DALILA DEL CARMEN MATA PEREZ',
            'email' => 'AACL@inbox.com',
            'rfc' => 'AACL508851',
            'curp' => 'AACL508851',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00641',
            'password' => Hash::make('AACL217073362559'),
        ]);
        
        User::factory()->create([
            'name' => 'ENA AMERICA GARCIA GARCIA',
            'email' => 'ACAA@live.com',
            'rfc' => 'ACAA367505',
            'curp' => 'ACAA367505',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00755',
            'password' => Hash::make('ACAA793424704417'),
        ]);
        
        User::factory()->create([
            'name' => 'MAYDA ARACELY MAS TUN',
            'email' => 'ULLA@inbox.com',
            'rfc' => 'ULLA104543',
            'curp' => 'ULLA104543',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00201',
            'password' => Hash::make('ULLA658746379318'),
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS SOFIA RIVERA LOPEZ',
            'email' => 'RLIO@icloud.com',
            'rfc' => 'RLIO536855',
            'curp' => 'RLIO536855',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00178',
            'password' => Hash::make('RLIO386601864950'),
        ]);
        
        User::factory()->create([
            'name' => 'VERONICA MARGARITA ROCA MENDEZ',
            'email' => 'CVCO@hotmail.com',
            'rfc' => 'CVCO569436',
            'curp' => 'CVCO569436',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00106',
            'password' => Hash::make('CVCO294919704267'),
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCA ZARATE LOPEZ',
            'email' => 'AEEZ@icloud.com',
            'rfc' => 'AEEZ817458',
            'curp' => 'AEEZ817458',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00369',
            'password' => Hash::make('AEEZ981107412998'),
        ]);
        
        User::factory()->create([
            'name' => 'DIANA LUISA AGUILAR RUELAS',
            'email' => 'AAGR@rocketmail.com',
            'rfc' => 'AAGR447174',
            'curp' => 'AAGR447174',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00604',
            'password' => Hash::make('AAGR928026632722'),
        ]);
        
        User::factory()->create([
            'name' => 'TANIA DOMINGUEZ FERNANDEZ',
            'email' => 'EAMA@live.com',
            'rfc' => 'EAMA248358',
            'curp' => 'EAMA248358',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00008',
            'password' => Hash::make('EAMA914894322013'),
        ]);
        
        User::factory()->create([
            'name' => 'TANIA GONZALEZ PEREZ',
            'email' => 'AEEP@hushmail.com',
            'rfc' => 'AEEP590404',
            'curp' => 'AEEP590404',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00369',
            'password' => Hash::make('AEEP597496829040'),
        ]);
        
        User::factory()->create([
            'name' => 'DELMA DEL CARMEN RABELO CUEVAS',
            'email' => 'ERAE@pm.me',
            'rfc' => 'ERAE002651',
            'curp' => 'ERAE002651',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00713',
            'password' => Hash::make('ERAE642841106091'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DEL ROSARIO CRUZ HERNANDEZ',
            'email' => 'AEAA@live.com',
            'rfc' => 'AEAA981877',
            'curp' => 'AEAA981877',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00497',
            'password' => Hash::make('AEAA859004798229'),
        ]);
        
        User::factory()->create([
            'name' => 'ANA MARIA LOPEZ HERNANDEZ',
            'email' => 'ILND@inbox.com',
            'rfc' => 'ILND272701',
            'curp' => 'ILND272701',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00847',
            'password' => Hash::make('ILND872840367108'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DEL CARMEN AVALOS TRUJILLO',
            'email' => 'IRLR@hotmail.com',
            'rfc' => 'IRLR878629',
            'curp' => 'IRLR878629',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00240',
            'password' => Hash::make('IRLR016016160910'),
        ]);
        
        User::factory()->create([
            'name' => 'HIPSI MARISOL ESTRELLA GUILLERMO',
            'email' => 'ELRM@gmail.com',
            'rfc' => 'ELRM835844',
            'curp' => 'ELRM835844',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00748',
            'password' => Hash::make('ELRM718407198127'),
        ]);
        
        User::factory()->create([
            'name' => 'MONICA FERNANDEZ MONTUFAR',
            'email' => 'MOZO@hushmail.com',
            'rfc' => 'MOZO952864',
            'curp' => 'MOZO952864',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00494',
            'password' => Hash::make('MOZO160028058097'),
        ]);
        
        User::factory()->create([
            'name' => 'MARICELA FLORES MOO',
            'email' => 'IAAL@mail.com',
            'rfc' => 'IAAL764104',
            'curp' => 'IAAL764104',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00046',
            'password' => Hash::make('IAAL797866066754'),
        ]);
        
        User::factory()->create([
            'name' => 'ABIGAIL GUTIERREZ MORALES',
            'email' => 'IGEA@inbox.com',
            'rfc' => 'IGEA274428',
            'curp' => 'IGEA274428',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00897',
            'password' => Hash::make('IGEA843174462382'),
        ]);
        
        User::factory()->create([
            'name' => 'BALBINA ALEJANDRA HIDALGO ZAVALA',
            'email' => 'GOEJ@gmail.com',
            'rfc' => 'GOEJ162060',
            'curp' => 'GOEJ162060',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'femenino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00787',
            'password' => Hash::make('GOEJ816309728860'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE ANTONIO JIMENEZ GUTIERREZ',
            'email' => 'EIEJ@pm.me',
            'rfc' => 'EIEJ481292',
            'curp' => 'EIEJ481292',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00915',
            'password' => Hash::make('EIEJ089780759479'),
        ]);
        
        User::factory()->create([
            'name' => 'JORGE PEREZ FALCONI',
            'email' => 'ZANO@protonmail.com',
            'rfc' => 'ZANO768101',
            'curp' => 'ZANO768101',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00647',
            'password' => Hash::make('ZANO692930948157'),
        ]);
        
        User::factory()->create([
            'name' => 'ISMAEL LOPEZ GARCES',
            'email' => 'ZPAE@inbox.com',
            'rfc' => 'ZPAE055934',
            'curp' => 'ZPAE055934',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00610',
            'password' => Hash::make('ZPAE577868104782'),
        ]);
        
        User::factory()->create([
            'name' => 'GASPAR DE JESUS NAH MISS',
            'email' => 'URGD@gmail.com',
            'rfc' => 'URGD392617',
            'curp' => 'URGD392617',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00159',
            'password' => Hash::make('URGD860392896143'),
        ]);
        
        User::factory()->create([
            'name' => 'DAHER ANTONIO PUCH RIVERA',
            'email' => 'OPIR@pm.me',
            'rfc' => 'OPIR428400',
            'curp' => 'OPIR428400',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00149',
            'password' => Hash::make('OPIR129629990845'),
        ]);
        
        User::factory()->create([
            'name' => 'OMAR ALBERTO TALANGO CERVANTES',
            'email' => 'OLTT@inbox.com',
            'rfc' => 'OLTT991567',
            'curp' => 'OLTT991567',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00375',
            'password' => Hash::make('OLTT161784931463'),
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS ENRIQUE UCAN YAM',
            'email' => 'QRIR@me.com',
            'rfc' => 'QRIR047440',
            'curp' => 'QRIR047440',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00807',
            'password' => Hash::make('QRIR453601013592'),
        ]);
        
        User::factory()->create([
            'name' => 'PEDRO ARMENTIA LOPEZ',
            'email' => 'IIRE@pm.me',
            'rfc' => 'IIRE377408',
            'curp' => 'IIRE377408',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00806',
            'password' => Hash::make('IIRE418885655308'),
        ]);
        
        User::factory()->create([
            'name' => 'ALDO ROMAN CONTRERAS UC',
            'email' => 'NOUM@zoho.com',
            'rfc' => 'NOUM424415',
            'curp' => 'NOUM424415',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00522',
            'password' => Hash::make('NOUM970487960259'),
        ]);
        
        User::factory()->create([
            'name' => 'PEDRO HERNANDEZ MACDONALD',
            'email' => 'DNDR@pm.me',
            'rfc' => 'DNDR297215',
            'curp' => 'DNDR297215',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00591',
            'password' => Hash::make('DNDR995178873708'),
        ]);
        
        User::factory()->create([
            'name' => 'IGNACIO JOSE MUÑOZ HERNANDEZ',
            'email' => 'AECÑ@hotmail.com',
            'rfc' => 'AECÑ922995',
            'curp' => 'AECÑ922995',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00096',
            'password' => Hash::make('AECÑ312740747834'),
        ]);
        
        User::factory()->create([
            'name' => 'JORGE SALIM ABRAHAM QUIJANO',
            'email' => 'EAAA@inbox.com',
            'rfc' => 'EAAA157440',
            'curp' => 'EAAA157440',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00551',
            'password' => Hash::make('EAAA535510115039'),
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL ANGEL POOL ALPUCHE',
            'email' => 'GLEO@gmx.com',
            'rfc' => 'GLEO166633',
            'curp' => 'GLEO166633',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00946',
            'password' => Hash::make('GLEO804201383339'),
        ]);
        
        User::factory()->create([
            'name' => 'JHOSUE JESUS RODRIGUEZ GOLIB',
            'email' => 'UJGI@msn.com',
            'rfc' => 'UJGI912256',
            'curp' => 'UJGI912256',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00752',
            'password' => Hash::make('UJGI874541335761'),
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES FERNANDEZ DEL VALLE LAISEQUILLA',
            'email' => 'LDQE@zoho.com',
            'rfc' => 'LDQE013194',
            'curp' => 'LDQE013194',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00943',
            'password' => Hash::make('LDQE553118547118'),
        ]);
        
        User::factory()->create([
            'name' => 'PAUL ALFREDO ARCE ONTIVEROS',
            'email' => 'OOUF@hotmail.com',
            'rfc' => 'OOUF039667',
            'curp' => 'OOUF039667',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00086',
            'password' => Hash::make('OOUF369263146596'),
        ]);
        
        User::factory()->create([
            'name' => 'ELIAS NOE BAEZA AKE',
            'email' => 'OIEE@hushmail.com',
            'rfc' => 'OIEE424195',
            'curp' => 'OIEE424195',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00177',
            'password' => Hash::make('OIEE405188864969'),
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRO MOO CERVERA',
            'email' => 'ANEA@outlook.com',
            'rfc' => 'ANEA856259',
            'curp' => 'ANEA856259',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SECRETARIO GENERAL',
            'sex' => 'masculino',
            'lvl' => '2',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00606',
            'password' => Hash::make('ANEA129224120613'),
        ]);
        
        User::factory()->create([
            'name' => 'OSCAR JOSUE MUÑOZ SIMA',
            'email' => 'SUIO@gmx.com',
            'rfc' => 'SUIO104020',
            'curp' => 'SUIO104020',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'TITULAR ORGANO INTERNO DE CONTROL',
            'sex' => 'masculino',
            'lvl' => '2',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00098',
            'password' => Hash::make('SUIO759250107753'),
        ]);
        
        User::factory()->create([
            'name' => 'ANA ELISA VARGAS ROSADO',
            'email' => 'SAAA@protonmail.com',
            'rfc' => 'SAAA376239',
            'curp' => 'SAAA376239',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'ASESOR',
            'sex' => 'femenino',
            'lvl' => '3',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00740',
            'password' => Hash::make('SAAA264566413179'),
        ]);
        
        
        User::factory()->create([
            'name' => 'SERGIO MANUEL VEGA CARRILLO',
            'email' => 'RCIA@live.com',
            'rfc' => 'RCIA048267',
            'curp' => 'RCIA048267',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00567',
            'password' => Hash::make('RCIA446444719411'),
        ]);
        
        User::factory()->create([
            'name' => 'IVAN ALEJANDRO ARA ANGULO',
            'email' => 'VIRA@msn.com',
            'rfc' => 'VIRA695316',
            'curp' => 'VIRA695316',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00291',
            'password' => Hash::make('VIRA487674732389'),
        ]);
        
        User::factory()->create([
            'name' => 'GILBERTO REYES CUEVAS',
            'email' => 'GEEE@icloud.com',
            'rfc' => 'GEEE940774',
            'curp' => 'GEEE940774',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00489',
            'password' => Hash::make('GEEE674550141484'),
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCO JULIAN TAMAY CHI',
            'email' => 'OHNU@mail.com',
            'rfc' => 'OHNU127285',
            'curp' => 'OHNU127285',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00477',
            'password' => Hash::make('OHNU876489719984'),
        ]);
        
        User::factory()->create([
            'name' => 'JORGE ANTONIO BAZAN ZUBELDIA',
            'email' => 'AOEU@icloud.com',
            'rfc' => 'AOEU283123',
            'curp' => 'AOEU283123',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00550',
            'password' => Hash::make('AOEU240484559702'),
        ]);
        
        User::factory()->create([
            'name' => 'ADRIANA GEORGINA SANDOVAL MARTINEZ',
            'email' => 'SMSI@aol.com',
            'rfc' => 'SMSI174169',
            'curp' => 'SMSI174169',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00865',
            'password' => Hash::make('SMSI902949251302'),
        ]);
        
        User::factory()->create([
            'name' => 'NESTOR MAURICIO BARRERA ESQUIVEL',
            'email' => 'UNAR@msn.com',
            'rfc' => 'UNAR014084',
            'curp' => 'UNAR014084',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00280',
            'password' => Hash::make('UNAR168529886089'),
        ]);
        
        User::factory()->create([
            'name' => 'SONIA ALEJANDRA CASTILLO PERALTA',
            'email' => 'RLAN@aol.com',
            'rfc' => 'RLAN060368',
            'curp' => 'RLAN060368',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00827',
            'password' => Hash::make('RLAN691069803440'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DE LOS ANGELES ZAMORA MAYA',
            'email' => 'SMLL@gmx.com',
            'rfc' => 'SMLL763737',
            'curp' => 'SMLL763737',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00191',
            'password' => Hash::make('SMLL376850306325'),
        ]);
        
        User::factory()->create([
            'name' => 'MINERVA GUADALUPE REJON MENA',
            'email' => 'IDLN@hotmail.com',
            'rfc' => 'IDLN993450',
            'curp' => 'IDLN993450',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00052',
            'password' => Hash::make('IDLN333880081586'),
        ]);
        
        User::factory()->create([
            'name' => 'KAREN VIETMEIER CAHUICH',
            'email' => 'IRER@zoho.com',
            'rfc' => 'IRER583965',
            'curp' => 'IRER583965',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00803',
            'password' => Hash::make('IRER135799247773'),
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL GONZALEZ FLORES',
            'email' => 'LELR@yandex.com',
            'rfc' => 'LELR589462',
            'curp' => 'LELR589462',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00559',
            'password' => Hash::make('LELR286006177129'),
        ]);
        
        User::factory()->create([
            'name' => 'RUBEN EDUARDO JIMENEZ JUAREZ',
            'email' => 'OMNE@mail.com',
            'rfc' => 'OMNE014224',
            'curp' => 'OMNE014224',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00564',
            'password' => Hash::make('OMNE773517594683'),
        ]);
        
        User::factory()->create([
            'name' => 'MARITZA DEL CARMEN ARCOS CRUZ',
            'email' => 'ENEE@yandex.com',
            'rfc' => 'ENEE112605',
            'curp' => 'ENEE112605',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00794',
            'password' => Hash::make('ENEE364187968374'),
        ]);
        
        User::factory()->create([
            'name' => 'IRLANDA JAQUELINE FIERROS BOJORQUEZ',
            'email' => 'QOQR@yahoo.com',
            'rfc' => 'QOQR067055',
            'curp' => 'QOQR067055',
            'direction' => 'JUNTA DE GOBIERNO Y ADMINISTRACIÓN',
            'position' => 'DIRECTOR',
            'sex' => 'femenino',
            'lvl' => '4',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00453',
            'password' => Hash::make('QOQR964417806766'),
        ]);
        
        User::factory()->create([
            'name' => 'EMILIO RODRIGUEZ HERRERA',
            'email' => 'EZIR@fastmail.com',
            'rfc' => 'EZIR619162',
            'curp' => 'EZIR619162',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00286',
            'password' => Hash::make('EZIR224137066123'),
        ]);
        
        User::factory()->create([
            'name' => 'EMMANUEL JESUS TURRIZA AGUILAR',
            'email' => 'RUUS@mail.com',
            'rfc' => 'RUUS531143',
            'curp' => 'RUUS531143',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00701',
            'password' => Hash::make('RUUS785077300549'),
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES DE JESUS ALEJANDRE RODRIGUEZ',
            'email' => 'RAEO@msn.com',
            'rfc' => 'RAEO519864',
            'curp' => 'RAEO519864',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00935',
            'password' => Hash::make('RAEO832525012652'),
        ]);
        
        User::factory()->create([
            'name' => 'BENJAMIN PINZON QUINTANA',
            'email' => 'PAAJ@yahoo.com',
            'rfc' => 'PAAJ980632',
            'curp' => 'PAAJ980632',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00535',
            'password' => Hash::make('PAAJ546642428660'),
        ]);
        
        User::factory()->create([
            'name' => 'LAURA NOEMI UC NAAL',
            'email' => 'AUOI@hotmail.com',
            'rfc' => 'AUOI588411',
            'curp' => 'AUOI588411',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00543',
            'password' => Hash::make('AUOI578149339319'),
        ]);
        
        User::factory()->create([
            'name' => 'SONIA DE LA LUZ ALPUCHE SIERRA',
            'email' => 'EIES@gmail.com',
            'rfc' => 'EIES099574',
            'curp' => 'EIES099574',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00480',
            'password' => Hash::make('EIES691670256957'),
        ]);
        
        User::factory()->create([
            'name' => 'MADELEYNE DE LOS ANGELES ACEVEDO PEREZ',
            'email' => 'EEEE@me.com',
            'rfc' => 'EEEE627459',
            'curp' => 'EEEE627459',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00955',
            'password' => Hash::make('EEEE598566640512'),
        ]);
        
        User::factory()->create([
            'name' => 'GENESIS BELEN CASTILLO MAAS',
            'email' => 'GEII@pm.me',
            'rfc' => 'GEII309799',
            'curp' => 'GEII309799',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00628',
            'password' => Hash::make('GEII027041748436'),
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES ALBERTO CHAN COUOH',
            'email' => 'AORO@icloud.com',
            'rfc' => 'AORO945626',
            'curp' => 'AORO945626',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00411',
            'password' => Hash::make('AORO000052870532'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIO ENRIQUE MORENO RAMOS',
            'email' => 'QOEI@rocketmail.com',
            'rfc' => 'QOEI503682',
            'curp' => 'QOEI503682',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00737',
            'password' => Hash::make('QOEI220034075966'),
        ]);
        
        User::factory()->create([
            'name' => 'ELIUD JOKSAN RIOS MANZANILLA',
            'email' => 'UZIS@inbox.com',
            'rfc' => 'UZIS409494',
            'curp' => 'UZIS409494',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00544',
            'password' => Hash::make('UZIS403112364966'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE LUIS SANSORES PEREZ',
            'email' => 'NSJR@inbox.com',
            'rfc' => 'NSJR759109',
            'curp' => 'NSJR759109',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00227',
            'password' => Hash::make('NSJR249864037233'),
        ]);
        
        User::factory()->create([
            'name' => 'JHONI ARMANDO PULIDO YAH',
            'email' => 'ANOJ@pm.me',
            'rfc' => 'ANOJ881353',
            'curp' => 'ANOJ881353',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00022',
            'password' => Hash::make('ANOJ602514574547'),
        ]);
        
        User::factory()->create([
            'name' => 'KERREL DICLAUDIA VILLARINO PERERA',
            'email' => 'VEOC@icloud.com',
            'rfc' => 'VEOC081358',
            'curp' => 'VEOC081358',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00242',
            'password' => Hash::make('VEOC800947931512'),
        ]);
        
        User::factory()->create([
            'name' => 'RUSBY AZUL DAMIAN PLASCENCIA',
            'email' => 'LCPA@icloud.com',
            'rfc' => 'LCPA576970',
            'curp' => 'LCPA576970',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00610',
            'password' => Hash::make('LCPA592586820795'),
        ]);
        
        User::factory()->create([
            'name' => 'JULIA ESPERANZA RUIZ CASTELLOT',
            'email' => 'LTAU@hotmail.com',
            'rfc' => 'LTAU336648',
            'curp' => 'LTAU336648',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00848',
            'password' => Hash::make('LTAU615137496919'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA GUADALUPE CORINA POZOS LANZ',
            'email' => 'MAAG@fastmail.com',
            'rfc' => 'MAAG956786',
            'curp' => 'MAAG956786',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'femenino',
            'lvl' => '5',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00223',
            'password' => Hash::make('MAAG804657449237'),
        ]);
        
        User::factory()->create([
            'name' => 'GUADALUPE DEL SOCORRO SOSA HUCHIN',
            'email' => 'OHEE@gmx.com',
            'rfc' => 'OHEE218343',
            'curp' => 'OHEE218343',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00469',
            'password' => Hash::make('OHEE230696076712'),
        ]);
        
        User::factory()->create([
            'name' => 'SILVIA DEL CARMEN KUMUL MENDOZA',
            'email' => 'UUEA@outlook.com',
            'rfc' => 'UUEA808445',
            'curp' => 'UUEA808445',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00286',
            'password' => Hash::make('UUEA937779478324'),
        ]);
        
        User::factory()->create([
            'name' => 'JUAN DIAZ ORTEGA',
            'email' => 'EZGU@pm.me',
            'rfc' => 'EZGU208948',
            'curp' => 'EZGU208948',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00683',
            'password' => Hash::make('EZGU308009804212'),
        ]);
        
        User::factory()->create([
            'name' => 'LAURA DEL CARMEN GUERRERO GARCIA',
            'email' => 'ALCE@tutanota.com',
            'rfc' => 'ALCE263163',
            'curp' => 'ALCE263163',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00481',
            'password' => Hash::make('ALCE974155088629'),
        ]);
        
        User::factory()->create([
            'name' => 'FLOR DE MARIA GUADALUPE COLLI EK',
            'email' => 'EIUG@hotmail.com',
            'rfc' => 'EIUG218140',
            'curp' => 'EIUG218140',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00932',
            'password' => Hash::make('EIUG517263339923'),
        ]);
        
        User::factory()->create([
            'name' => 'LYDIA MARGARITA CORTEZ ZUBIETA',
            'email' => 'GRZO@yahoo.com',
            'rfc' => 'GRZO564148',
            'curp' => 'GRZO564148',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00012',
            'password' => Hash::make('GRZO056756606117'),
        ]);
        
        User::factory()->create([
            'name' => 'NYLDA MARIA JONGUITUD PEREZ',
            'email' => 'IIPA@yandex.com',
            'rfc' => 'IIPA175513',
            'curp' => 'IIPA175513',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00617',
            'password' => Hash::make('IIPA115469502444'),
        ]);
        
        User::factory()->create([
            'name' => 'ROBERTO EDUARDO CARRILLO GONZALEZ',
            'email' => 'OOOR@fastmail.com',
            'rfc' => 'OOOR747933',
            'curp' => 'OOOR747933',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00270',
            'password' => Hash::make('OOOR141159135347'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSUE DAVID CASTILLO ',
            'email' => 'JAUS@live.com',
            'rfc' => 'JAUS064947',
            'curp' => 'JAUS064947',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00853',
            'password' => Hash::make('JAUS994847668283'),
        ]);
        
        User::factory()->create([
            'name' => 'VICTOR ROMAN ORTIZ ABREU',
            'email' => 'vroa74@gmail.com',
            'rfc' => 'ZOOZ401477',
            'curp' => 'ZOOZ401477',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00040',
            'password' => Hash::make('Campeche2024.'),
        ]);
        
        User::factory()->create([
            'name' => 'GLORIA DEL ROSARIO JIMENEZ CUPUL',
            'email' => 'CEPD@gmail.com',
            'rfc' => 'CEPD136743',
            'curp' => 'CEPD136743',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00229',
            'password' => Hash::make('CEPD300605149554'),
        ]);
        
        User::factory()->create([
            'name' => 'LAURA DEL JESUS COLLI AKE',
            'email' => 'LSIK@icloud.com',
            'rfc' => 'LSIK800215',
            'curp' => 'LSIK800215',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00301',
            'password' => Hash::make('LSIK537870416572'),
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS MARGARITA GRAMAJO PIEDRASANTA',
            'email' => 'RSIA@yandex.com',
            'rfc' => 'RSIA027300',
            'curp' => 'RSIA027300',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'femenino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00691',
            'password' => Hash::make('RSIA040767498084'),
        ]);
        
        User::factory()->create([
            'name' => 'JAVIER DAVID ROMERO TUN',
            'email' => 'UARM@mail.com',
            'rfc' => 'UARM074568',
            'curp' => 'UARM074568',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00810',
            'password' => Hash::make('UARM723955881355'),
        ]);
        
        User::factory()->create([
            'name' => 'RAFAEL ARMANDO DZIB AVILA',
            'email' => 'MAOM@me.com',
            'rfc' => 'MAOM507599',
            'curp' => 'MAOM507599',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00524',
            'password' => Hash::make('MAOM936845315025'),
        ]);
        
        User::factory()->create([
            'name' => 'ROMAN LEON HERRERA',
            'email' => 'ENOR@yandex.com',
            'rfc' => 'ENOR964997',
            'curp' => 'ENOR964997',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00084',
            'password' => Hash::make('ENOR564315317780'),
        ]);
        
        User::factory()->create([
            'name' => 'VICTOR HUGO ZAMORANO RUIZ',
            'email' => 'UMUN@fastmail.com',
            'rfc' => 'UMUN869549',
            'curp' => 'UMUN869549',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00208',
            'password' => Hash::make('UMUN938947882597'),
        ]);
        
        User::factory()->create([
            'name' => 'GERARDO DANIEL MUÑOZ CHAN',
            'email' => 'AENA@hotmail.com',
            'rfc' => 'AENA265432',
            'curp' => 'AENA265432',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00385',
            'password' => Hash::make('AENA117350969111'),
        ]);
        
        User::factory()->create([
            'name' => 'JORGE ALBERTO XOOL VILLARREAL',
            'email' => 'ETLE@gmx.com',
            'rfc' => 'ETLE742306',
            'curp' => 'ETLE742306',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00525',
            'password' => Hash::make('ETLE124919381150'),
        ]);
        
        User::factory()->create([
            'name' => 'ADDA MARISOL RAMOS TORRES',
            'email' => 'MRSR@msn.com',
            'rfc' => 'MRSR801185',
            'curp' => 'MRSR801185',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00133',
            'password' => Hash::make('MRSR426618584926'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE MANUEL HERNANDEZ VALLE',
            'email' => 'UORS@hushmail.com',
            'rfc' => 'UORS200642',
            'curp' => 'UORS200642',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00573',
            'password' => Hash::make('UORS676177421610'),
        ]);
        
        User::factory()->create([
            'name' => 'CLAUDIA MARIELA CAN VAZQUEZ',
            'email' => 'MLUD@mail.com',
            'rfc' => 'MLUD945357',
            'curp' => 'MLUD945357',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00613',
            'password' => Hash::make('MLUD004263236175'),
        ]);
        
        User::factory()->create([
            'name' => 'RICARDO FRANCISCO RODRIGUEZ CERVERA',
            'email' => 'CFID@hotmail.com',
            'rfc' => 'CFID191501',
            'curp' => 'CFID191501',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00696',
            'password' => Hash::make('CFID333347347522'),
        ]);
        
        User::factory()->create([
            'name' => 'TERESITA DE JESUS DELGADO NOVELO',
            'email' => 'DSAD@outlook.com',
            'rfc' => 'DSAD888104',
            'curp' => 'DSAD888104',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00440',
            'password' => Hash::make('DSAD687699324594'),
        ]);
        
        User::factory()->create([
            'name' => 'JONHNI ABRAHAM BUZON VERA',
            'email' => 'VNMR@live.com',
            'rfc' => 'VNMR623249',
            'curp' => 'VNMR623249',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00518',
            'password' => Hash::make('VNMR582416946060'),
        ]);
        
        User::factory()->create([
            'name' => 'LILIA MARGARITA PEREZ CAAMAL',
            'email' => 'AAIA@yahoo.com',
            'rfc' => 'AAIA468390',
            'curp' => 'AAIA468390',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00250',
            'password' => Hash::make('AAIA735549238464'),
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO MARTIN VERA REYES',
            'email' => 'EAVD@gmail.com',
            'rfc' => 'EAVD613966',
            'curp' => 'EAVD613966',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00176',
            'password' => Hash::make('EAVD586983545560'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL FRANCISCO SOSA HUICAB',
            'email' => 'RCAR@yahoo.com',
            'rfc' => 'RCAR935408',
            'curp' => 'RCAR935408',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00049',
            'password' => Hash::make('RCAR322965573678'),
        ]);
        
        User::factory()->create([
            'name' => 'LUIS FERNANDO ALAYOLA MOO',
            'email' => 'MSAA@gmx.com',
            'rfc' => 'MSAA357214',
            'curp' => 'MSAA357214',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00384',
            'password' => Hash::make('MSAA871836577424'),
        ]);
        
        User::factory()->create([
            'name' => 'ANA LILIA HERRERA CHI',
            'email' => 'RELE@yandex.com',
            'rfc' => 'RELE533829',
            'curp' => 'RELE533829',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00646',
            'password' => Hash::make('RELE223284287508'),
        ]);
        
        User::factory()->create([
            'name' => 'ROXANA YOMARA SOLIS GARRIDO',
            'email' => 'AARR@zoho.com',
            'rfc' => 'AARR235456',
            'curp' => 'AARR235456',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00176',
            'password' => Hash::make('AARR407239082389'),
        ]);
        
        User::factory()->create([
            'name' => 'PATRICIA DEL CARMEN HERNANDEZ BAAS',
            'email' => 'NLET@msn.com',
            'rfc' => 'NLET885408',
            'curp' => 'NLET885408',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00152',
            'password' => Hash::make('NLET282443458522'),
        ]);
        
        User::factory()->create([
            'name' => 'LETICIA DE MONSERRAT LARA GUERRERO',
            'email' => 'TRLR@tutanota.com',
            'rfc' => 'TRLR826176',
            'curp' => 'TRLR826176',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00066',
            'password' => Hash::make('TRLR230438722209'),
        ]);
        
        User::factory()->create([
            'name' => 'HUGO DANIEL MORA CASANOVA',
            'email' => 'AAIM@hotmail.com',
            'rfc' => 'AAIM210456',
            'curp' => 'AAIM210456',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00868',
            'password' => Hash::make('AAIM244650429686'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE ISRAEL LUNA ARJONA',
            'email' => 'SOLE@msn.com',
            'rfc' => 'SOLE227919',
            'curp' => 'SOLE227919',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00492',
            'password' => Hash::make('SOLE067946016474'),
        ]);
        
        User::factory()->create([
            'name' => 'LUISA DEL ROSARIO GUERRERO GARCIA',
            'email' => 'AIER@yahoo.com',
            'rfc' => 'AIER759610',
            'curp' => 'AIER759610',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00311',
            'password' => Hash::make('AIER877030298186'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE DEL CARMEN MARTINEZ NUÑEZ',
            'email' => 'AMÑT@tutanota.com',
            'rfc' => 'AMÑT002306',
            'curp' => 'AMÑT002306',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00724',
            'password' => Hash::make('AMÑT537747904164'),
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO MARTIN SOBERANIS MONTALVO',
            'email' => 'ATOS@hotmail.com',
            'rfc' => 'ATOS809864',
            'curp' => 'ATOS809864',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00272',
            'password' => Hash::make('ATOS988968296147'),
        ]);
        
        User::factory()->create([
            'name' => 'FRYNE DEL SOCORRO CRUZ YERBES',
            'email' => 'EERC@protonmail.com',
            'rfc' => 'EERC224296',
            'curp' => 'EERC224296',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'femenino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00771',
            'password' => Hash::make('EERC192930787432'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE FERNANDO PUC YE',
            'email' => 'CNOU@yahoo.com',
            'rfc' => 'CNOU732514',
            'curp' => 'CNOU732514',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00950',
            'password' => Hash::make('CNOU791206280138'),
        ]);
        
        User::factory()->create([
            'name' => 'ENRIQUE HUMBERTO LARA PARRAO',
            'email' => 'AOER@yandex.com',
            'rfc' => 'AOER640291',
            'curp' => 'AOER640291',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00172',
            'password' => Hash::make('AOER500723330813'),
        ]);
        
        User::factory()->create([
            'name' => 'ROCIO VERONICA UC MASS',
            'email' => 'ARAC@msn.com',
            'rfc' => 'ARAC263018',
            'curp' => 'ARAC263018',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00792',
            'password' => Hash::make('ARAC889144387192'),
        ]);
        
        User::factory()->create([
            'name' => 'CHRISTIAN ALEXANDER BE PECH',
            'email' => 'EPRE@zoho.com',
            'rfc' => 'EPRE363705',
            'curp' => 'EPRE363705',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00643',
            'password' => Hash::make('EPRE732606538932'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE EDUARDO CHAVARRIA SOLER',
            'email' => 'SAAR@rocketmail.com',
            'rfc' => 'SAAR238987',
            'curp' => 'SAAR238987',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00893',
            'password' => Hash::make('SAAR037748864270'),
        ]);
        
        User::factory()->create([
            'name' => 'LIGIA DEL JESUS SEGOVIA PRESUEL',
            'email' => 'GEAA@yahoo.com',
            'rfc' => 'GEAA144746',
            'curp' => 'GEAA144746',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00029',
            'password' => Hash::make('GEAA095485141106'),
        ]);
        
        User::factory()->create([
            'name' => 'HENRY RENE TUZ BALAN',
            'email' => 'HYYA@yandex.com',
            'rfc' => 'HYYA076211',
            'curp' => 'HYYA076211',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00863',
            'password' => Hash::make('HYYA927755371353'),
        ]);
        
        User::factory()->create([
            'name' => 'PERLA LETICIA YAN QUIJANO',
            'email' => 'AIAI@rocketmail.com',
            'rfc' => 'AIAI221840',
            'curp' => 'AIAI221840',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00652',
            'password' => Hash::make('AIAI319073128942'),
        ]);
        
        User::factory()->create([
            'name' => 'LAURA MARTINA ZAPATA ARCHIVOR',
            'email' => 'NZAV@zoho.com',
            'rfc' => 'NZAV864249',
            'curp' => 'NZAV864249',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00698',
            'password' => Hash::make('NZAV662199937181'),
        ]);
        
        User::factory()->create([
            'name' => 'NORMA GUADALUPE CORONEL DIAZ',
            'email' => 'GRAI@zoho.com',
            'rfc' => 'GRAI709012',
            'curp' => 'GRAI709012',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00665',
            'password' => Hash::make('GRAI687136305843'),
        ]);
        
        User::factory()->create([
            'name' => 'MARDONIO CARMONA NOLASCO',
            'email' => 'NIAN@gmail.com',
            'rfc' => 'NIAN714187',
            'curp' => 'NIAN714187',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00069',
            'password' => Hash::make('NIAN028340738053'),
        ]);
        
        User::factory()->create([
            'name' => 'ALONSO PUC YE',
            'email' => 'ASUU@me.com',
            'rfc' => 'ASUU753132',
            'curp' => 'ASUU753132',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00316',
            'password' => Hash::make('ASUU163487159463'),
        ]);
        
        User::factory()->create([
            'name' => 'BERENICE YANET XOOL VILLARREAL',
            'email' => 'EILN@aol.com',
            'rfc' => 'EILN944789',
            'curp' => 'EILN944789',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00806',
            'password' => Hash::make('EILN406819587796'),
        ]);
        
        User::factory()->create([
            'name' => 'ALBA JAEL MOO RAMIREZ',
            'email' => 'BRLO@gmx.com',
            'rfc' => 'BRLO629403',
            'curp' => 'BRLO629403',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA',
            'sex' => 'femenino',
            'lvl' => '9',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00659',
            'password' => Hash::make('BRLO621034845835'),
        ]);
        
        User::factory()->create([
            'name' => 'SILVIA VERONICA GONZALEZ MUÑOZ',
            'email' => 'ÑOVZ@fastmail.com',
            'rfc' => 'ÑOVZ629787',
            'curp' => 'ÑOVZ629787',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'femenino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00238',
            'password' => Hash::make('ÑOVZ945937464530'),
        ]);
        
        User::factory()->create([
            'name' => 'MARLENE DE JESUS GRAMAJO PIEDRASANTA',
            'email' => 'RSRS@protonmail.com',
            'rfc' => 'RSRS986853',
            'curp' => 'RSRS986853',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'femenino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00363',
            'password' => Hash::make('RSRS589674227779'),
        ]);
        
        User::factory()->create([
            'name' => 'CARMEN ILIANA PEREZ PUERTO',
            'email' => 'AUIR@yandex.com',
            'rfc' => 'AUIR921117',
            'curp' => 'AUIR921117',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'femenino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00543',
            'password' => Hash::make('AUIR122864041254'),
        ]);
        
        User::factory()->create([
            'name' => 'DANIEL DZIB CANCHE',
            'email' => 'HDZC@hotmail.com',
            'rfc' => 'HDZC414145',
            'curp' => 'HDZC414145',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00265',
            'password' => Hash::make('HDZC059455469043'),
        ]);
        
        User::factory()->create([
            'name' => 'MARCOS ELIAS CHE UC',
            'email' => 'SMEL@yahoo.com',
            'rfc' => 'SMEL910666',
            'curp' => 'SMEL910666',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00719',
            'password' => Hash::make('SMEL323022917613'),
        ]);
        
        User::factory()->create([
            'name' => 'MIREYA LUCELY RIVERO PEREZ',
            'email' => 'RERR@icloud.com',
            'rfc' => 'RERR711839',
            'curp' => 'RERR711839',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'femenino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00932',
            'password' => Hash::make('RERR529998665113'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE LUIS MONTENEGRO CU',
            'email' => 'SIJO@tutanota.com',
            'rfc' => 'SIJO902300',
            'curp' => 'SIJO902300',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00930',
            'password' => Hash::make('SIJO666081588135'),
        ]);
        
        User::factory()->create([
            'name' => 'DAVID AGUILAR ESCAMILLA',
            'email' => 'DLIC@tutanota.com',
            'rfc' => 'DLIC219207',
            'curp' => 'DLIC219207',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00239',
            'password' => Hash::make('DLIC817332973480'),
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCO DEL CARMEN MEZA CAAMAL',
            'email' => 'ECRD@hotmail.com',
            'rfc' => 'ECRD910878',
            'curp' => 'ECRD910878',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00886',
            'password' => Hash::make('ECRD912523256039'),
        ]);
        
        User::factory()->create([
            'name' => 'ALESSANDRA GUADALUPE MARTINEZ VELA',
            'email' => 'AGLD@msn.com',
            'rfc' => 'AGLD269616',
            'curp' => 'AGLD269616',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00400',
            'password' => Hash::make('AGLD940902800185'),
        ]);
        
        User::factory()->create([
            'name' => 'BIANCA GRACIELA CHAN CAB',
            'email' => 'EHCR@gmail.com',
            'rfc' => 'EHCR314953',
            'curp' => 'EHCR314953',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00729',
            'password' => Hash::make('EHCR642019725351'),
        ]);
        
        User::factory()->create([
            'name' => 'JULIO CESAR CHAVELAS GUERRERO',
            'email' => 'USER@outlook.com',
            'rfc' => 'USER494650',
            'curp' => 'USER494650',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00738',
            'password' => Hash::make('USER238987785053'),
        ]);
        
        User::factory()->create([
            'name' => 'SURI YARELI GUZMAN PECH',
            'email' => 'EUCI@rocketmail.com',
            'rfc' => 'EUCI589108',
            'curp' => 'EUCI589108',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00414',
            'password' => Hash::make('EUCI758990819348'),
        ]);
        
        User::factory()->create([
            'name' => 'LEOPOLDO SUTTEN MENDOZA',
            'email' => 'SOZT@tutanota.com',
            'rfc' => 'SOZT603777',
            'curp' => 'SOZT603777',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00819',
            'password' => Hash::make('SOZT173018565575'),
        ]);
        
        User::factory()->create([
            'name' => 'FABIAN ZAYD ROQUE MARTINEZ',
            'email' => 'NANE@tutanota.com',
            'rfc' => 'NANE996661',
            'curp' => 'NANE996661',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00490',
            'password' => Hash::make('NANE613760796076'),
        ]);
        
        User::factory()->create([
            'name' => 'LUISA FERNANDA PACHECO VALLADARES',
            'email' => 'ESRD@pm.me',
            'rfc' => 'ESRD255789',
            'curp' => 'ESRD255789',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00456',
            'password' => Hash::make('ESRD143636687303'),
        ]);
        
        User::factory()->create([
            'name' => 'MARLENE SARAI GOMEZ LOPEZ',
            'email' => 'MLOE@protonmail.com',
            'rfc' => 'MLOE317369',
            'curp' => 'MLOE317369',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00894',
            'password' => Hash::make('MLOE049630873422'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL FERNANDO VALLE PINZON',
            'email' => 'LURU@yahoo.com',
            'rfc' => 'LURU159989',
            'curp' => 'LURU159989',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00851',
            'password' => Hash::make('LURU801371591926'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA JOSE DE LOS ANGELES GARCIA DE LA CRUZ',
            'email' => 'IODU@aol.com',
            'rfc' => 'IODU182253',
            'curp' => 'IODU182253',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00464',
            'password' => Hash::make('IODU518386911885'),
        ]);
        
        User::factory()->create([
            'name' => 'FLOR ILEANA RAMIREZ MAY',
            'email' => 'OEMM@gmail.com',
            'rfc' => 'OEMM176083',
            'curp' => 'OEMM176083',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00945',
            'password' => Hash::make('OEMM382756585364'),
        ]);
        
        User::factory()->create([
            'name' => 'BLANCA LETICIA MIJARES ALEJANDRO',
            'email' => 'AAEI@gmx.com',
            'rfc' => 'AAEI406090',
            'curp' => 'AAEI406090',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00881',
            'password' => Hash::make('AAEI685758782991'),
        ]);
        
        User::factory()->create([
            'name' => 'KATHERYN ROMERO YANEZ',
            'email' => 'EETT@hotmail.com',
            'rfc' => 'EETT582573',
            'curp' => 'EETT582573',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00449',
            'password' => Hash::make('EETT310726124843'),
        ]);
        
        User::factory()->create([
            'name' => 'ESTEFANIA ABRAHAM DOMINGUEZ',
            'email' => 'MRUF@protonmail.com',
            'rfc' => 'MRUF683500',
            'curp' => 'MRUF683500',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00641',
            'password' => Hash::make('MRUF268142259340'),
        ]);
        
        User::factory()->create([
            'name' => 'EMILIANO PATRON GONZALEZ',
            'email' => 'IINO@protonmail.com',
            'rfc' => 'IINO489887',
            'curp' => 'IINO489887',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00485',
            'password' => Hash::make('IINO857011903389'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA CONCEPCION ARCOS JIMENEZ',
            'email' => 'MPCE@aol.com',
            'rfc' => 'MPCE555713',
            'curp' => 'MPCE555713',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00035',
            'password' => Hash::make('MPCE749030079580'),
        ]);
        
        User::factory()->create([
            'name' => 'SALVADOR JAUREGUI GONZALEZ',
            'email' => 'AEIL@hotmail.com',
            'rfc' => 'AEIL426840',
            'curp' => 'AEIL426840',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00790',
            'password' => Hash::make('AEIL121648209643'),
        ]);
        
        User::factory()->create([
            'name' => 'JEANCARLO DE JESUS SANCHEZ BOLON',
            'email' => 'AOAE@yandex.com',
            'rfc' => 'AOAE268377',
            'curp' => 'AOAE268377',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00578',
            'password' => Hash::make('AOAE876093384008'),
        ]);
        
        User::factory()->create([
            'name' => 'ANAMITA OCAÑA FRANCO',
            'email' => 'MAOA@yandex.com',
            'rfc' => 'MAOA348451',
            'curp' => 'MAOA348451',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00768',
            'password' => Hash::make('MAOA067684164442'),
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS BEATRIZ SOSA GARCIA',
            'email' => 'GCLS@hushmail.com',
            'rfc' => 'GCLS568763',
            'curp' => 'GCLS568763',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00036',
            'password' => Hash::make('GCLS539265054049'),
        ]);
        
        User::factory()->create([
            'name' => 'IRVING HOWARD AC CHI',
            'email' => 'VVWR@rocketmail.com',
            'rfc' => 'VVWR126309',
            'curp' => 'VVWR126309',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00506',
            'password' => Hash::make('VVWR617679247940'),
        ]);
        
        User::factory()->create([
            'name' => 'FATIMA DEL ROSARIO PEREZ GUTIERREZ',
            'email' => 'TORT@gmail.com',
            'rfc' => 'TORT290353',
            'curp' => 'TORT290353',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00475',
            'password' => Hash::make('TORT640144625241'),
        ]);
        
        User::factory()->create([
            'name' => 'LUIS GABRIEL CANCHE CANUL',
            'email' => 'ENCC@hotmail.com',
            'rfc' => 'ENCC947439',
            'curp' => 'ENCC947439',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00734',
            'password' => Hash::make('ENCC274148349801'),
        ]);
        
        User::factory()->create([
            'name' => 'JUAN DANIEL HERNANDEZ HERNANDEZ',
            'email' => 'NZDN@gmx.com',
            'rfc' => 'NZDN632181',
            'curp' => 'NZDN632181',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00907',
            'password' => Hash::make('NZDN340227988457'),
        ]);
        
        User::factory()->create([
            'name' => 'EMMA MARTINEZ FLORES',
            'email' => 'INRO@icloud.com',
            'rfc' => 'INRO702894',
            'curp' => 'INRO702894',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00094',
            'password' => Hash::make('INRO642104823672'),
        ]);
        
        User::factory()->create([
            'name' => 'FREDY DEL CARMEN VILLANUEVA JIMENEZ',
            'email' => 'URDE@fastmail.com',
            'rfc' => 'URDE622409',
            'curp' => 'URDE622409',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00209',
            'password' => Hash::make('URDE228982276142'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSIAS JOSMAR CORDOVA BAEZA',
            'email' => 'IMRR@me.com',
            'rfc' => 'IMRR665261',
            'curp' => 'IMRR665261',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00495',
            'password' => Hash::make('IMRR146405219057'),
        ]);
        
        User::factory()->create([
            'name' => 'GILBERTO MATUS ZARATE',
            'email' => 'ARGT@outlook.com',
            'rfc' => 'ARGT879261',
            'curp' => 'ARGT879261',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00676',
            'password' => Hash::make('ARGT200909709448'),
        ]);
        
        User::factory()->create([
            'name' => 'JESSICA MARIA MAYOR PEREZ',
            'email' => 'SCRC@me.com',
            'rfc' => 'SCRC142191',
            'curp' => 'SCRC142191',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00359',
            'password' => Hash::make('SCRC411295100957'),
        ]);
        
        User::factory()->create([
            'name' => 'ANGEL EDUARDO LEZAMA CANUL',
            'email' => 'LREA@pm.me',
            'rfc' => 'LREA611934',
            'curp' => 'LREA611934',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00077',
            'password' => Hash::make('LREA361869401306'),
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS RAMIRO SOSA PACHECO',
            'email' => 'CIOA@mail.com',
            'rfc' => 'CIOA872722',
            'curp' => 'CIOA872722',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00702',
            'password' => Hash::make('CIOA170818342875'),
        ]);
        
        User::factory()->create([
            'name' => 'IVETTE DEL CARMEN MOLINA QUE',
            'email' => 'MIVU@inbox.com',
            'rfc' => 'MIVU684318',
            'curp' => 'MIVU684318',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00262',
            'password' => Hash::make('MIVU747419467332'),
        ]);
        
        User::factory()->create([
            'name' => 'LILIANA LIZETH GAMBOA MATOS',
            'email' => 'LGAH@gmx.com',
            'rfc' => 'LGAH061911',
            'curp' => 'LGAH061911',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00595',
            'password' => Hash::make('LGAH883686745999'),
        ]);
        
        User::factory()->create([
            'name' => 'EDGAR ALEJANDRO ALMEYDA MALDONADO',
            'email' => 'YEAA@msn.com',
            'rfc' => 'YEAA978433',
            'curp' => 'YEAA978433',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00658',
            'password' => Hash::make('YEAA207118841564'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL ALBERTO ORDOÑEZ MARTINEZ',
            'email' => 'LAOÑ@hotmail.com',
            'rfc' => 'LAOÑ603159',
            'curp' => 'LAOÑ603159',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00409',
            'password' => Hash::make('LAOÑ599400938633'),
        ]);
        
        User::factory()->create([
            'name' => 'DANIEL JEZLEEL VILLARREAL HUCHIN',
            'email' => 'RLAV@gmail.com',
            'rfc' => 'RLAV045894',
            'curp' => 'RLAV045894',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00000',
            'password' => Hash::make('RLAV804569999170'),
        ]);
        
        User::factory()->create([
            'name' => 'ELIEZER ISAI CRUZ LOPEZ',
            'email' => 'ILEE@zoho.com',
            'rfc' => 'ILEE886651',
            'curp' => 'ILEE886651',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00865',
            'password' => Hash::make('ILEE975502064474'),
        ]);
        
        User::factory()->create([
            'name' => 'HILDA DEL ROSARIO DE LA CRUZ POOT',
            'email' => 'LLRA@hotmail.com',
            'rfc' => 'LLRA058636',
            'curp' => 'LLRA058636',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00699',
            'password' => Hash::make('LLRA863606773778'),
        ]);
        
        User::factory()->create([
            'name' => 'LUIS MARIO UITZ POOT',
            'email' => 'SLMO@rocketmail.com',
            'rfc' => 'SLMO412148',
            'curp' => 'SLMO412148',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00397',
            'password' => Hash::make('SLMO695000985513'),
        ]);
        
        User::factory()->create([
            'name' => 'BRISA YAJAIRA DE LA CRUZ SALAZAR',
            'email' => 'JZLR@mail.com',
            'rfc' => 'JZLR893999',
            'curp' => 'JZLR893999',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00353',
            'password' => Hash::make('JZLR141266102662'),
        ]);
        
        User::factory()->create([
            'name' => 'EDITH DEL CARMEN HERNANDEZ PEREZ',
            'email' => 'EHEE@icloud.com',
            'rfc' => 'EHEE226435',
            'curp' => 'EHEE226435',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00501',
            'password' => Hash::make('EHEE362828548840'),
        ]);
        
        User::factory()->create([
            'name' => 'BENNY DEL JESUS MORENO ZARATE',
            'email' => 'SLSN@aol.com',
            'rfc' => 'SLSN994377',
            'curp' => 'SLSN994377',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00516',
            'password' => Hash::make('SLSN764140805264'),
        ]);
        
        User::factory()->create([
            'name' => 'ROMAN DEL ANGEL TRUJILLO MIJANGOS',
            'email' => 'ODOI@aol.com',
            'rfc' => 'ODOI112627',
            'curp' => 'ODOI112627',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00644',
            'password' => Hash::make('ODOI124985652339'),
        ]);
        
        User::factory()->create([
            'name' => 'CESAR ALBERTO CHI PEREYRA',
            'email' => 'REEE@fastmail.com',
            'rfc' => 'REEE579016',
            'curp' => 'REEE579016',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00348',
            'password' => Hash::make('REEE104024362331'),
        ]);
        
        User::factory()->create([
            'name' => 'NICOLAS US CAHUICH',
            'email' => 'CUUU@me.com',
            'rfc' => 'CUUU997022',
            'curp' => 'CUUU997022',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00343',
            'password' => Hash::make('CUUU104049406211'),
        ]);
        
        User::factory()->create([
            'name' => 'LUIS ALBERTO MAY CHUC',
            'email' => 'UAUM@me.com',
            'rfc' => 'UAUM142836',
            'curp' => 'UAUM142836',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00486',
            'password' => Hash::make('UAUM488023079312'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL DE JESUS RIVERO SALAZAR',
            'email' => 'EEEN@yandex.com',
            'rfc' => 'EEEN578678',
            'curp' => 'EEEN578678',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00034',
            'password' => Hash::make('EEEN055467070843'),
        ]);
        
        User::factory()->create([
            'name' => 'IRVIN AZIEL ABAN CORTEZ',
            'email' => 'BENE@gmx.com',
            'rfc' => 'BENE211676',
            'curp' => 'BENE211676',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00124',
            'password' => Hash::make('BENE257803512027'),
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL ANGEL ESPINO SEGURA',
            'email' => 'IOAL@yahoo.com',
            'rfc' => 'IOAL319446',
            'curp' => 'IOAL319446',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00312',
            'password' => Hash::make('IOAL899616100542'),
        ]);
        
        User::factory()->create([
            'name' => 'JUAN MANUEL BAEZA CHAVARRIA',
            'email' => 'HAIU@fastmail.com',
            'rfc' => 'HAIU109297',
            'curp' => 'HAIU109297',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00054',
            'password' => Hash::make('HAIU504398359031'),
        ]);
        
        User::factory()->create([
            'name' => 'JENNIFER OSORIO ASCENCIO',
            'email' => 'CNII@fastmail.com',
            'rfc' => 'CNII630190',
            'curp' => 'CNII630190',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00756',
            'password' => Hash::make('CNII542409909458'),
        ]);
        
        User::factory()->create([
            'name' => 'GARY HOUDINE CERVERA MONTERO',
            'email' => 'EHER@yandex.com',
            'rfc' => 'EHER256809',
            'curp' => 'EHER256809',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00166',
            'password' => Hash::make('EHER572687747933'),
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRA GUADALUPE RODRIGUEZ BARRERA',
            'email' => 'ARNN@outlook.com',
            'rfc' => 'ARNN822604',
            'curp' => 'ARNN822604',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00677',
            'password' => Hash::make('ARNN879513932321'),
        ]);
        
        User::factory()->create([
            'name' => 'DARWIN ERNESTO ZAVALA MARTINEZ',
            'email' => 'RSOL@pm.me',
            'rfc' => 'RSOL563654',
            'curp' => 'RSOL563654',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00928',
            'password' => Hash::make('RSOL868246771703'),
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALBERTO DZUL LOPEZ',
            'email' => 'SPJZ@rocketmail.com',
            'rfc' => 'SPJZ251837',
            'curp' => 'SPJZ251837',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00825',
            'password' => Hash::make('SPJZ595132917505'),
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO ENRIQUE MAY LOPEZ',
            'email' => 'ADOE@tutanota.com',
            'rfc' => 'ADOE479019',
            'curp' => 'ADOE479019',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00786',
            'password' => Hash::make('ADOE139584079850'),
        ]);
        
        User::factory()->create([
            'name' => 'DIANA GISSELLE GONZALEZ AVILA',
            'email' => 'AIAS@pm.me',
            'rfc' => 'AIAS366334',
            'curp' => 'AIAS366334',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00062',
            'password' => Hash::make('AIAS619664964514'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL JESUS GUTIERREZ CAMPOS',
            'email' => 'IEUI@inbox.com',
            'rfc' => 'IEUI875302',
            'curp' => 'IEUI875302',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00571',
            'password' => Hash::make('IEUI508090119130'),
        ]);
        
        User::factory()->create([
            'name' => 'PRISSILA BEATRIZ MALDONADO FERRAEZ',
            'email' => 'SEOL@msn.com',
            'rfc' => 'SEOL129941',
            'curp' => 'SEOL129941',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00158',
            'password' => Hash::make('SEOL580579777468'),
        ]);
        
        User::factory()->create([
            'name' => 'VICENTE HERNANDEZ CABAÑAS',
            'email' => 'CÑCN@live.com',
            'rfc' => 'CÑCN943198',
            'curp' => 'CÑCN943198',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00737',
            'password' => Hash::make('CÑCN128722630035'),
        ]);
        
        User::factory()->create([
            'name' => 'EMILIO GABRIEL HUCHIN HERNANDEZ',
            'email' => 'LHNH@msn.com',
            'rfc' => 'LHNH099938',
            'curp' => 'LHNH099938',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00229',
            'password' => Hash::make('LHNH459639916268'),
        ]);
        
        User::factory()->create([
            'name' => 'ORAIMA BARAJAS VILLASEÑOR',
            'email' => 'SIAI@rocketmail.com',
            'rfc' => 'SIAI057596',
            'curp' => 'SIAI057596',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00424',
            'password' => Hash::make('SIAI494928202693'),
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS ALBERTO BAUTISTA ARROYO',
            'email' => 'ERLB@gmx.com',
            'rfc' => 'ERLB902361',
            'curp' => 'ERLB902361',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00679',
            'password' => Hash::make('ERLB039711725391'),
        ]);
        
        User::factory()->create([
            'name' => 'ALONDRA DEL ROSARIO MISS BALAM',
            'email' => 'LBED@gmx.com',
            'rfc' => 'LBED815043',
            'curp' => 'LBED815043',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00108',
            'password' => Hash::make('LBED727091383370'),
        ]);
        
        User::factory()->create([
            'name' => 'JESUS DAVID CARRION MARTIN',
            'email' => 'NISE@mail.com',
            'rfc' => 'NISE464432',
            'curp' => 'NISE464432',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00114',
            'password' => Hash::make('NISE302516986320'),
        ]);
        
        User::factory()->create([
            'name' => 'HECTOR MANUEL PALOMO GONZALEZ',
            'email' => 'LNRP@zoho.com',
            'rfc' => 'LNRP230653',
            'curp' => 'LNRP230653',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00437',
            'password' => Hash::make('LNRP228894639044'),
        ]);
        
        User::factory()->create([
            'name' => 'CRISTHEL EUNICE CU EK',
            'email' => 'CREU@inbox.com',
            'rfc' => 'CREU601464',
            'curp' => 'CREU601464',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00846',
            'password' => Hash::make('CREU181394165482'),
        ]);
        
        User::factory()->create([
            'name' => 'LAURA SURISADAI CRUZ MENDEZ',
            'email' => 'IISA@hotmail.com',
            'rfc' => 'IISA381675',
            'curp' => 'IISA381675',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00665',
            'password' => Hash::make('IISA587378299341'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE DANIEL VIRRUETA HIDALGO',
            'email' => 'ILAO@inbox.com',
            'rfc' => 'ILAO017323',
            'curp' => 'ILAO017323',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00736',
            'password' => Hash::make('ILAO478407042660'),
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL HUMBERTO FLORES GAMBOA',
            'email' => 'LERA@me.com',
            'rfc' => 'LERA563378',
            'curp' => 'LERA563378',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00035',
            'password' => Hash::make('LERA366462381180'),
        ]);
        
        User::factory()->create([
            'name' => 'BRISEYDA XILONEN JIMENEZ CASTILLO',
            'email' => 'SBXI@pm.me',
            'rfc' => 'SBXI780744',
            'curp' => 'SBXI780744',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00732',
            'password' => Hash::make('SBXI244551280484'),
        ]);
        
        User::factory()->create([
            'name' => 'SAMANTA JOSEFINA MEDINA R DE LA GALA',
            'email' => 'MIAN@yahoo.com',
            'rfc' => 'MIAN840063',
            'curp' => 'MIAN840063',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00373',
            'password' => Hash::make('MIAN442952789165'),
        ]);
        
        User::factory()->create([
            'name' => 'KARINA LIZETH AGUILAR RODRIGUEZ',
            'email' => 'UHKI@me.com',
            'rfc' => 'UHKI001076',
            'curp' => 'UHKI001076',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00384',
            'password' => Hash::make('UHKI247433229468'),
        ]);
        
        User::factory()->create([
            'name' => 'KARLA GUADALUPE PEREZ LLANOS',
            'email' => 'LERD@icloud.com',
            'rfc' => 'LERD115634',
            'curp' => 'LERD115634',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00610',
            'password' => Hash::make('LERD300222668565'),
        ]);
        
        User::factory()->create([
            'name' => 'IRIS GABRIELA GARCIA MORENO',
            'email' => 'IRIR@hushmail.com',
            'rfc' => 'IRIR381740',
            'curp' => 'IRIR381740',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00406',
            'password' => Hash::make('IRIR774228736321'),
        ]);
        
        User::factory()->create([
            'name' => 'EZEQUIAS HERNANDEZ TORRES',
            'email' => 'REEI@live.com',
            'rfc' => 'REEI070581',
            'curp' => 'REEI070581',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00454',
            'password' => Hash::make('REEI297395022384'),
        ]);
        
        User::factory()->create([
            'name' => 'BRIANDA ISABEL COYOC TORRES',
            'email' => 'CERO@pm.me',
            'rfc' => 'CERO786590',
            'curp' => 'CERO786590',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00706',
            'password' => Hash::make('CERO090805242207'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE URIEL EUAN PECH',
            'email' => 'CJEC@outlook.com',
            'rfc' => 'CJEC089698',
            'curp' => 'CJEC089698',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00206',
            'password' => Hash::make('CJEC803901720628'),
        ]);
        
        User::factory()->create([
            'name' => 'JESSICA HERNANDEZ LEON',
            'email' => 'ONLH@tutanota.com',
            'rfc' => 'ONLH489348',
            'curp' => 'ONLH489348',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00310',
            'password' => Hash::make('ONLH757762300202'),
        ]);
        
        User::factory()->create([
            'name' => 'DIANA RUBI DELGADO PLASCENCIA',
            'email' => 'LNGA@mail.com',
            'rfc' => 'LNGA960017',
            'curp' => 'LNGA960017',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00507',
            'password' => Hash::make('LNGA228227709737'),
        ]);
        
        User::factory()->create([
            'name' => 'FATIMA GUTIERREZ PEREZ',
            'email' => 'RTER@protonmail.com',
            'rfc' => 'RTER929407',
            'curp' => 'RTER929407',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00147',
            'password' => Hash::make('RTER337205901338'),
        ]);
        
        User::factory()->create([
            'name' => 'SERGIO AGUSTIN EK CHE',
            'email' => 'TSAH@icloud.com',
            'rfc' => 'TSAH423335',
            'curp' => 'TSAH423335',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00249',
            'password' => Hash::make('TSAH945280942226'),
        ]);
        
        User::factory()->create([
            'name' => 'RAMON ALFONSO MENA PINZON',
            'email' => 'MALP@protonmail.com',
            'rfc' => 'MALP244632',
            'curp' => 'MALP244632',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00458',
            'password' => Hash::make('MALP279525989555'),
        ]);
        
        User::factory()->create([
            'name' => 'HOENER DEL CARMEN COLLI CASANOVA',
            'email' => 'SVRC@me.com',
            'rfc' => 'SVRC591128',
            'curp' => 'SVRC591128',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00547',
            'password' => Hash::make('SVRC012901644081'),
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRO DEL JESUS RAMIREZ MAY',
            'email' => 'EMNZ@outlook.com',
            'rfc' => 'EMNZ182754',
            'curp' => 'EMNZ182754',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00575',
            'password' => Hash::make('EMNZ532268229322'),
        ]);
        
        User::factory()->create([
            'name' => 'NICHELDDI CUEVAS VARGAS',
            'email' => 'SDVA@aol.com',
            'rfc' => 'SDVA180379',
            'curp' => 'SDVA180379',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00254',
            'password' => Hash::make('SDVA109627742057'),
        ]);
        
        User::factory()->create([
            'name' => 'RAFAEL ENRIQUE FONOY CALDERON',
            'email' => 'NAYC@pm.me',
            'rfc' => 'NAYC277463',
            'curp' => 'NAYC277463',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00301',
            'password' => Hash::make('NAYC213944722042'),
        ]);
        
        User::factory()->create([
            'name' => 'LEON FELIPE REYES PEREZ',
            'email' => 'EPRO@gmail.com',
            'rfc' => 'EPRO725717',
            'curp' => 'EPRO725717',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00340',
            'password' => Hash::make('EPRO852755553876'),
        ]);
        
        User::factory()->create([
            'name' => 'JOSE FRANCISCO LOPEZ CORTES',
            'email' => 'ROCC@aol.com',
            'rfc' => 'ROCC569007',
            'curp' => 'ROCC569007',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00816',
            'password' => Hash::make('ROCC691490061012'),
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALEJANDRO BAUTISTA CHAN',
            'email' => 'HASB@icloud.com',
            'rfc' => 'HASB818665',
            'curp' => 'HASB818665',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00274',
            'password' => Hash::make('HASB558893211903'),
        ]);
        
        User::factory()->create([
            'name' => 'EDGAR DAMIAN CARRION MARTIN',
            'email' => 'AIIC@aol.com',
            'rfc' => 'AIIC001986',
            'curp' => 'AIIC001986',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00255',
            'password' => Hash::make('AIIC289046023353'),
        ]);
        
        User::factory()->create([
            'name' => 'FILIBERTO MIGUEL HERNANDEZ ROJAS',
            'email' => 'GERM@tutanota.com',
            'rfc' => 'GERM502958',
            'curp' => 'GERM502958',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00613',
            'password' => Hash::make('GERM807350567666'),
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALBERTO HEREDIA MAGAÑA',
            'email' => 'ILRE@gmx.com',
            'rfc' => 'ILRE060027',
            'curp' => 'ILRE060027',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00815',
            'password' => Hash::make('ILRE089423108426'),
        ]);
        
        User::factory()->create([
            'name' => 'RIBIN CASTRO CORONADO',
            'email' => 'CDON@aol.com',
            'rfc' => 'CDON535356',
            'curp' => 'CDON535356',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00233',
            'password' => Hash::make('CDON980381498852'),
        ]);
        
        User::factory()->create([
            'name' => 'ROXANA GUADALUPE ESPINOSA CARREON',
            'email' => 'ANOR@rocketmail.com',
            'rfc' => 'ANOR706809',
            'curp' => 'ANOR706809',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00294',
            'password' => Hash::make('ANOR165807938164'),
        ]);
        
        User::factory()->create([
            'name' => 'GUILLERMO RAMON DZIB QUEB',
            'email' => 'NMGR@me.com',
            'rfc' => 'NMGR322410',
            'curp' => 'NMGR322410',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00328',
            'password' => Hash::make('NMGR865237012455'),
        ]);
        
        User::factory()->create([
            'name' => 'ALBERTO DE JESUS CASTILLO MENDOZA',
            'email' => 'SMUC@me.com',
            'rfc' => 'SMUC107068',
            'curp' => 'SMUC107068',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00209',
            'password' => Hash::make('SMUC348170851922'),
        ]);
        
        User::factory()->create([
            'name' => 'NATALI CONCEPCION GONZALEZ MOO',
            'email' => 'CNCM@tutanota.com',
            'rfc' => 'CNCM530906',
            'curp' => 'CNCM530906',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00044',
            'password' => Hash::make('CNCM575530941256'),
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DE LOURDES ROSADO BRITO',
            'email' => 'SRDA@live.com',
            'rfc' => 'SRDA042446',
            'curp' => 'SRDA042446',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'femenino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00497',
            'password' => Hash::make('SRDA723204755511'),
        ]);
        
        User::factory()->create([
            'name' => 'GERARDO DE JESUS MEX AVILA',
            'email' => 'AEDX@me.com',
            'rfc' => 'AEDX575337',
            'curp' => 'AEDX575337',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'profile_photo_path' => 'profile-photos/00756',
            'password' => Hash::make('AEDX464037955568'),
        ]);


    }
}
