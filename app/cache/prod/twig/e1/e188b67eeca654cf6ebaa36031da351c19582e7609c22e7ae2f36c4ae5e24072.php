<?php

/* FOSUserBundle:Resetting:request_content.html.twig */
class __TwigTemplate_3fe03e579ac2af78552ef745263b07155bb4667a9a54bebe86551134d4f39674 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<form action=\"";
        echo $this->env->getExtension('routing')->getPath("sonata_user_resetting_send_email");
        echo "\" method=\"POST\" class=\"fos_user_resetting_request\">
    ";
        // line 2
        if (array_key_exists("invalid_username", $context)) {
            // line 3
            echo "        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.request.invalid_username", array("%username%" => (isset($context["invalid_username"]) ? $context["invalid_username"] : null)), "FOSUserBundle"), "html", null, true);
            echo "</div>
    ";
        }
        // line 5
        echo "
    <div class=\"form-group\">
        <label for=\"username\" class=\"control-label required\">";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.request.username", array(), "FOSUserBundle"), "html", null, true);
        echo " * </label>
        <input type=\"text\" id=\"username\" name=\"username\" required=\"required\" />
    </div>

    <div class=\"form-actions form-group\">
        <div class=\"col-sm-offset-3 col-sm-9\">
            <input type=\"submit\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.request.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" class=\"btn btn-primary\" />
        </div>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:request_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 13,  36 => 7,  32 => 5,  26 => 3,  24 => 2,  19 => 1,);
    }
}
/* <form action="{{ path('sonata_user_resetting_send_email') }}" method="POST" class="fos_user_resetting_request">*/
/*     {% if invalid_username is defined %}*/
/*         <div class="alert alert-danger">{{ 'resetting.request.invalid_username'|trans({'%username%': invalid_username}, 'FOSUserBundle') }}</div>*/
/*     {% endif %}*/
/* */
/*     <div class="form-group">*/
/*         <label for="username" class="control-label required">{{ 'resetting.request.username'|trans({}, 'FOSUserBundle') }} * </label>*/
/*         <input type="text" id="username" name="username" required="required" />*/
/*     </div>*/
/* */
/*     <div class="form-actions form-group">*/
/*         <div class="col-sm-offset-3 col-sm-9">*/
/*             <input type="submit" value="{{ 'resetting.request.submit'|trans({}, 'FOSUserBundle') }}" class="btn btn-primary" />*/
/*         </div>*/
/*     </div>*/
/* </form>*/
/* */
