<?php

namespace app\modules\advertiser\models;

use Yii;



/**
 * This is the model class for table "{{%beta_teasers}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $campaign_id
 * @property integer $section_id
 * @property string $ban_site
 * @property string $ban_region
 * @property string $ban_country
 * @property string $ban_hour
 * @property string $ban_week_day
 * @property string $image
 * @property string $url
 * @property string $text
 * @property string $price
 * @property string $dataadd
 * @property string $dataedit
 * @property string $last_show
 * @property string $button
 * @property integer $stars
 * @property integer $status
 */
class Teasers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%beta_teasers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'url', 'text', 'price','title'], 'required'],
            [['user_id', 'campaign_id', 'section_id', 'stars', 'status'], 'integer'],
            [['button', 'stars','section_id','ban_site', 'ban_region', 'ban_country', 'ban_hour', 'ban_week_day'], 'safe'],
            [['price'], 'number'],
            [['dataadd', 'dataedit', 'last_show'], 'safe'],
            [['image', 'url', 'text'], 'string', 'max' => 255],
            [['button'], 'string', 'max' => 16],
            ['title','string','max'=>75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User'),
            'campaign_id' => Yii::t('app', 'Campaign'),
            'section_id' => Yii::t('app', 'Section'),
            'ban_site' => Yii::t('app', 'Ban Site'),
            'ban_region' => Yii::t('app', 'Ban Region'),
            'ban_country' => Yii::t('app', 'Ban Country'),
            'ban_hour' => Yii::t('app', 'Ban Hour'),
            'ban_week_day' => Yii::t('app', 'Ban Week Day'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'dataadd' => Yii::t('app', 'Dataadd'),
            'dataedit' => Yii::t('app', 'Dataedit'),
            'last_show' => Yii::t('app', 'Last Show'),
            'button' => Yii::t('app', 'Button'),
            'stars' => Yii::t('app', 'Stars'),
            'status' => Yii::t('app', 'Status'),
        ];
    }


    public function saveImage($img,$id,$files)
    {   

        $model = Teasers::findOne($id);

         // create dir if not exist
            $dir1 ="ads/350";
            $dir2 ="ads/200";
            $dir3 ="ads/90";

           
            // create dir if not exist
            if(!file_exists($dir1)){
                mkdir($dir1);
            }
            if(!file_exists($dir2)){
                mkdir($dir2);
            }
            if(!file_exists($dir3)){
                mkdir($dir3);
            }


        // if gif image then 
        if($files['file_input']['type'] == 'image/gif')
        {  
            $filename   = $id.".gif"; // file must save as gif for resizing , else it cause some animation problem.
            $newName    = $id.".jpg"; // this name will be use after resizing will done 

            $tem_name = $files['file_input']['name'];

            /* temp dir to hold gif file for resizing process , it is not recommended to use $_FILES['temp_name'];
                process must hold gif image at actual path, else it cause some resizing problem, or might etract all the frames of the gif image.
            */
            $tem_dir = "ads/temp_gif"; 

            if(!file_exists($tem_dir))
            {
                mkdir($tem_dir);
            }
            // store file for some time to process the resizing.

            move_uploaded_file($files['file_input']['tmp_name'], $tem_dir.'/'.$tem_name);


            // php Imagick extention to resize the gif image 
            // the tempary file that are inside web/$tem_dir/ will be read by this function
            $image = new \Imagick(Yii::getAlias($tem_dir.'/'.$tem_name)); 

            $image = $image->coalesceImages(); 


             // for 305x350
            foreach ($image as $frame) 
            { 
              $frame->thumbnailImage(350, 350); 
            } 

            $image = $image->deconstructImages(); 
            $image->writeImages(Yii::getAlias($dir1.'/'.$filename), true); 

             // rename the file to jpg
            rename(Yii::getAlias($dir1.'/'.$filename),Yii::getAlias($dir1.'/'.$newName));

             // for 200x200
            foreach ($image as $frame) 
            { 
              $frame->thumbnailImage(200, 200); 
            } 

            $image = $image->deconstructImages(); 
            $image->writeImages(Yii::getAlias($dir2.'/'.$filename), true);

             // rename the file to jpg
            rename(Yii::getAlias($dir2.'/'.$filename),Yii::getAlias($dir2.'/'.$newName)); 

             // for 90x90
            foreach ($image as $frame) 
            { 
              $frame->thumbnailImage(90, 90); 
            } 

            $image = $image->deconstructImages(); 
            $image->writeImages(Yii::getAlias($dir3.'/'.$filename), true); 

            // rename the file to jpg
            rename(Yii::getAlias($dir3.'/'.$filename),Yii::getAlias($dir3.'/'.$newName));



            // delete temparary gif file
                array_map('unlink', glob("$tem_dir/*.*"));
               
            //  this will remove temp directory also, (not required), directory will auto created if not exist
                 rmdir($tem_dir); 

            
        }
        else
        {
            
            // check wether $img have base64 image data

            if(strlen($img) > 10){

         
            /* save base64 image in dir */

            $filename =  $id.".jpg";
           
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = $dir1 . '/'.$filename;
                $success = file_put_contents($file, $data);  // save data as image this is for 350x350
          
               

                // read file from 350 folder

                $thumb = new \Imagick(Yii::getAlias($dir1.'/'.$filename));

              
                // resize image, size 200x200

                $thumb->resizeImage(200,200,\Imagick::FILTER_LANCZOS,1);

                $thumb->writeImage(Yii::getAlias($dir2.'/'.$filename));


                 // resize image, size 90x90

                $thumb->resizeImage(90,90,\Imagick::FILTER_LANCZOS,1);

                $thumb->writeImage(Yii::getAlias($dir3.'/'.$filename));


              }  // end if;
             
        } // end else

        // save file name in table
        $model->image        = $id.".jpg";
        $model->save();
 
    } // end function

} // end class
