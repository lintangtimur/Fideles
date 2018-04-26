# Fideles
Create SQL file from Excel Header
## USAGE
```php
use Fideles\Fideles;

require 'vendor/autoload.php';

$fideles = new Fideles(__DIR__ . '/data.xlsx');
$fideles->createSql('tableName', 'fileName');
```
## OUTPUT
```sql

        /* Created By StelGenerator 
        	Created At: 2018-04-26 21:10:13
        */
CREATE TABLE assssd (
        	 id int(5) NOT NULL AUTO_INCREMENT,
        	 NO varchar(20) NOT NULL,
        	 NO_TES varchar(20) NOT NULL,
        	 NIM varchar(20) NOT NULL,
        	 NAMA varchar(20) NOT NULL,
        	 KOSENTRASI varchar(20) NOT NULL,
        	 ALAMAT varchar(20) NOT NULL,
        	 KOTA varchar(20) NOT NULL,
        	 KODEPOS varchar(20) NOT NULL,
        	 TELEPON varchar(20) NOT NULL,
        	 AGAMA varchar(20) NOT NULL,
        	 EMAIL varchar(20) NOT NULL,
        	 JENIS_SEKOLAH varchar(20) NOT NULL,
        	 NAMA_SEKOLAH varchar(20) NOT NULL,
        	 ALAMAT_SEKOLAH varchar(20) NOT NULL,
        	 KOTA_SEKOLAH varchar(20) NOT NULL,
        	 NAMA_ORTU varchar(20) NOT NULL,
        	 ALAMAT_ORTU varchar(20) NOT NULL,
        	 KOTA_ORTU varchar(20) NOT NULL,
        	 PRIMARY KEY(id)
);
```
