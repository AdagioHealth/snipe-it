<?php
namespace App\Http\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $username = '';
    public $password = '';
    public $can_submit = false;


    /**
     * Set the validation rules for login
     *
     * @author  A. Gianotto <snipe@snipe.net>
     * @version v6.0
     * @return Array
     */
    public function rules() 
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required',
        ];
    }

    /**
     * Perform the validation
     *
     * @author  A. Gianotto <snipe@snipe.net>
     * @version v6.0
     */
    public function updated($fields)
    {

        if (is_null($fields) || empty($fields)) {
            $this->can_submit = false;
        } 

        $this->validateOnly($fields);
    
        $this->can_submit = true;
        

    }
    
    /**
     * Actually do the login thing
     * 
     * @todo fix missing LDAP stuff maybe? Not sure if it 
     * makes sense to even do this via LiveWire, since 
     * our login system is pretty complicated.
     * 
     * @author  A. Gianotto <snipe@snipe.net>
     * @version v6.0
     */
    public function submitForm()
    {
        
        $this->can_submit = true;
        
        if (auth()->attempt($this->validate())) {
            return redirect()->intended('/');
        } else {
            return session()->flash('error', trans('auth/message.account_not_found'));
        }
              
    }


}
