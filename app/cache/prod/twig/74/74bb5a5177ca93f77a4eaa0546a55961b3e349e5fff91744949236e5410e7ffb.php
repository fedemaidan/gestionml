<?php

/* SonataUserBundle:Admin/Core:user_block.html.twig */
class __TwigTemplate_a0096fb644c29cc2bb515d1f9bf383d354f145e23da1c2293f184682cbcda47c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'user_block' => array($this, 'block_user_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('user_block', $context, $blocks);
    }

    public function block_user_block($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())) {
            // line 3
            echo "        ";
            $context["_bg_class"] = "bg-light-blue";
            // line 4
            echo "        ";
            $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl("sonata_user_admin_security_logout");
            // line 5
            echo "        ";
            $context["_logout_text"] = $this->env->getExtension('translator')->trans("user_block_logout", array(), "SonataUserBundle");
            // line 6
            echo "        ";
            $context["_profile_uri"] = (($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "userAdmin", array()), "isGranted", array(0 => "EDIT", 1 => $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "userAdmin", array()), "generateUrl", array(0 => "edit", 1 => array("id" => $this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "userAdmin", array()), "id", array(0 => $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())), "method"))), "method")) : ($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "userAdmin", array()), "generateUrl", array(0 => "show", 1 => array("id" => $this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "userAdmin", array()), "id", array(0 => $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array())), "method"))), "method")));
            // line 7
            echo "        ";
            $context["_profile_text"] = $this->env->getExtension('translator')->trans("user_block_profile", array(), "SonataUserBundle");
            // line 8
            echo "        ";
            $context["_user_image"] = (($this->env->getExtension('ornicar_gravatar')->exists($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "email", array()))) ? ($this->env->getExtension('ornicar_gravatar')->getUrl($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "email", array()))) : ($this->env->getExtension('asset')->getAssetUrl($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "defaultAvatar", array()))));
            // line 9
            echo "        ";
            // line 10
            echo "        ";
            // line 11
            echo "
        ";
            // line 12
            if (($this->env->getExtension('security')->isGranted("ROLE_PREVIOUS_ADMIN") && $this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "impersonating", array()))) {
                // line 13
                echo "            ";
                $context["_bg_class"] = "bg-light-green";
                // line 14
                echo "            ";
                $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "impersonating", array()), "route", array()), twig_array_merge($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : null), "impersonating", array()), "parameters", array()), array("_switch_user" => "_exit")));
                // line 15
                echo "            ";
                $context["_logout_text"] = $this->env->getExtension('translator')->trans("switch_user_exit", array(), "SonataUserBundle");
                // line 16
                echo "        ";
            }
            // line 17
            echo "
        <li class=\"user-header ";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["_bg_class"]) ? $context["_bg_class"] : null), "html", null, true);
            echo "\">
            ";
            // line 19
            if ((isset($context["_user_image"]) ? $context["_user_image"] : null)) {
                // line 20
                echo "                <img src=\"";
                echo twig_escape_filter($this->env, (isset($context["_user_image"]) ? $context["_user_image"] : null), "html", null, true);
                echo "\" class=\"img-circle\" alt=\"Avatar\" />
            ";
            }
            // line 22
            echo "            <p>
                ";
            // line 23
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "firstname", array()) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "lastname", array()))) {
                // line 24
                echo "                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "firstname", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "lastname", array()), "html", null, true);
                echo "
                ";
            } else {
                // line 26
                echo "                    ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "html", null, true);
                echo "
                ";
            }
            // line 28
            echo "            </p>
        </li>

";
            // line 37
            echo "
        <li class=\"user-footer\">
            <div class=\"pull-left\">
                <a href=\"";
            // line 40
            echo twig_escape_filter($this->env, (isset($context["_profile_uri"]) ? $context["_profile_uri"] : null), "html", null, true);
            echo "\" class=\"btn btn-default btn-flat\"><i class=\"fa fa-user\"></i> ";
            echo twig_escape_filter($this->env, (isset($context["_profile_text"]) ? $context["_profile_text"] : null), "html", null, true);
            echo "</a>
            </div>

            <div class=\"pull-right\">
                <a href=\"";
            // line 44
            echo twig_escape_filter($this->env, (isset($context["_logout_uri"]) ? $context["_logout_uri"] : null), "html", null, true);
            echo "\" class=\"btn btn-default btn-flat\"><i class=\"fa fa-sign-out fa-fw\"></i> ";
            echo twig_escape_filter($this->env, (isset($context["_logout_text"]) ? $context["_logout_text"] : null), "html", null, true);
            echo "</a>
            </div>
        </li>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Admin/Core:user_block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  121 => 44,  112 => 40,  107 => 37,  102 => 28,  96 => 26,  88 => 24,  86 => 23,  83 => 22,  77 => 20,  75 => 19,  71 => 18,  68 => 17,  65 => 16,  62 => 15,  59 => 14,  56 => 13,  54 => 12,  51 => 11,  49 => 10,  47 => 9,  44 => 8,  41 => 7,  38 => 6,  35 => 5,  32 => 4,  29 => 3,  26 => 2,  20 => 1,);
    }
}
/* {% block user_block %}*/
/*     {% if app.user %}*/
/*         {% set _bg_class          = "bg-light-blue" %}*/
/*         {% set _logout_uri        = url('sonata_user_admin_security_logout') %}*/
/*         {% set _logout_text       = 'user_block_logout'|trans({}, 'SonataUserBundle') %}*/
/*         {% set _profile_uri       = sonata_user.userAdmin.isGranted('EDIT', app.user) ? sonata_user.userAdmin.generateUrl('edit', {id: sonata_user.userAdmin.id(app.user)}) : sonata_user.userAdmin.generateUrl('show', {id: sonata_user.userAdmin.id(app.user)}) %}*/
/*         {% set _profile_text      = 'user_block_profile'|trans({}, 'SonataUserBundle') %}*/
/*         {% set _user_image        = gravatar_exists(app.user.email) ? gravatar(app.user.email) : asset(sonata_user.defaultAvatar) %}*/
/*         {# Customize this with your profile picture implementation, see below for example #}*/
/*         {#{% set _user_image  = app.user.profilePicture|default(asset(sonata_user.defaultAvatar)) %}#}*/
/* */
/*         {% if is_granted('ROLE_PREVIOUS_ADMIN') and sonata_user.impersonating %}*/
/*             {% set _bg_class    = "bg-light-green" %}*/
/*             {% set _logout_uri  = url(sonata_user.impersonating.route, sonata_user.impersonating.parameters| merge({'_switch_user': '_exit'})) %}*/
/*             {% set _logout_text = 'switch_user_exit'|trans({}, 'SonataUserBundle') %}*/
/*         {% endif %}*/
/* */
/*         <li class="user-header {{ _bg_class }}">*/
/*             {% if _user_image %}*/
/*                 <img src="{{ _user_image }}" class="img-circle" alt="Avatar" />*/
/*             {% endif %}*/
/*             <p>*/
/*                 {% if (app.user.firstname and app.user.lastname) %}*/
/*                     {{ app.user.firstname }} {{ app.user.lastname }}*/
/*                 {% else %}*/
/*                     {{ app.user }}*/
/*                 {% endif %}*/
/*             </p>*/
/*         </li>*/
/* */
/* {#*/
/*     Uncomment to add some information*/
/*         <li class="user-body">*/
/* */
/*         </li>*/
/* #}*/
/* */
/*         <li class="user-footer">*/
/*             <div class="pull-left">*/
/*                 <a href="{{ _profile_uri }}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> {{ _profile_text }}</a>*/
/*             </div>*/
/* */
/*             <div class="pull-right">*/
/*                 <a href="{{ _logout_uri }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out fa-fw"></i> {{ _logout_text }}</a>*/
/*             </div>*/
/*         </li>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
