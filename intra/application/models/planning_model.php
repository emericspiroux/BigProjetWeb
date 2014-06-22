<?php
class planning_model extends CI_Model
{
	function __construct()
  {
        parent::__construct();
  }

  public function keep_planning($date, $id_user)
  {
      $query = $this->db->query("Select distinct activity.*, module.name as module_name, inscrit_activity.inscrit AS inscrit_a, inscrit_module.inscrit AS inscrit_m
from activity left join inscrit_activity on inscrit_activity.id_activity = activity.id,
module left join inscrit_module on inscrit_module.id_mod = module.id
AND inscrit_module.id_user = ".$id_user." where activity.date_reg < '".$date."' AND activity.date_end > '".$date."' AND module.id = activity.id_mod AND  inscrit_module.inscrit = 1;");
      if (!$query->result_array())
        return (false);
      return $query;
  }
}
?>
