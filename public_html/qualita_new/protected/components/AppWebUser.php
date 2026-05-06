<?php
class AppWebUser extends CWebUser
{
    public function getRoles($name)
    {
        $user=User::model()->find('LOWER(emailAddress)=?',array($name));

        return $user->powerUser;
    }

    public function isEnabled($section = null, $operation = null, $id = 0)
    {
        $roleId = $this->getState('typeUserId');

        $role = UtentiTipi::model()->findByPk($roleId);
        $permission = json_decode($role->permissions, true);

        if($section == 'Area Documenti' || $section == 'DocumentiQualita' || $section == 'DocumentiSoggiorni') {
            //verificare se l'utente ha il permesso per la sezione sulla tabella users colonna area_documenti
            $user = Utenti::model()->findByPk(Yii::app()->user->getId());
            if($section == 'Area Documenti' && $user->area_documenti == 'Y') {
                return true;
            }
            if($section == 'DocumentiQualita' && $user->documenti_qualita == 'Y') {
                return true;
            }
            if($section == 'DocumentiSoggiorni' && $user->documenti_soggiorni == 'Y') {
                return true;
            }
        }
        else {
            if(isset($permission[$section]['enabled']) && $permission[$section]['enabled'] == 1) {
                return true;
            }
        }

        return false;
    }

    public function accessController($section)
    {
        $roleId = $this->getState('typeUserId');

        $role = UtentiTipi::model()->findByPk($roleId);
        $permission = json_decode($role->permissions, true);

        if(isset($permission[$section]['enabled']) && $permission[$section]['enabled'] == 1) {
            return [Yii::app()->user->getName()];
        }

        return [""];
    }

    public function can($section = null, $operation = null, $id = null)
    {
        //if(Yii::app()->user->getState('group') == 'USER') {
        if(!in_array(Yii::app()->user->getState('group'), ['DIRECTOR','ADMIN'])) {
            $roleId = $this->getState('typeUserId');
            $role = UtentiTipi::model()->findByPk($roleId);
            $permission = json_decode($role->permissions, true);

            if(isset($permission[$section][$operation]) && $permission[$section][$operation] == 1) {
                if($id && $id != Yii::app()->user->getId()) {
                    return false;
                }
                
                return true;
            }

            if($section == 'Area Documenti' && $operation == 'view') {
                //verificare se l'utente ha il permesso per la sezione sulla tabella users colonna area_documenti
                $user = Utenti::model()->findByPk(Yii::app()->user->getId());
                if($user->area_documenti == 'Y') {
                    return true;
                }
            }

            return false;
        }
        else {
            if(Yii::app()->user->getState('group') != 'ADMIN') {
                if($section == 'Area Documenti') {
                    if($operation == 'view') {
                        //verificare se l'utente ha il permesso per la sezione sulla tabella users colonna area_documenti
                        $user = Utenti::model()->findByPk(Yii::app()->user->getId());
                        if($user->area_documenti == 'Y') {
                            return true;
                        }
                    }

                    return false;
                }
            }

            return true;
        }
    }
}