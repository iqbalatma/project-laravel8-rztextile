

$(document).ready(function(){

  /**
   * Description : selectize option configuration
   */
  const selectizeOption = {
    create: false,
    sortField: "text",
    openOnFocus: false,
    render: {
        option: function(data, escape) {
            return `<div class="item-roll-selectized"
                        data-id="${escape(data.data.id)}"
                        data-data="${escape(JSON.stringify(data.data))}">
                        ${escape(data.text)}
                    </div>`
        }
    },
    onChange: function(value) {
      onChangeSelectize(value)
    }
  }
    /**
   * Description : use to clear and always focus on selectize
   * 
   * @param {object} selectized initialize of selectize
   */
  function selectizedFocusAndClear(selectized) {
    selectized =  selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function(value) {
        onChangeSelectize(value);
    });
  }

   /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
    function onChangeSelectize(value) {
      const rollId = value;
      const dataSet =$(`.item-roll-selectized[data-id="${rollId}"]`).data("data"); 
  
      console.log(dataSet);
      // setSelectedOptionToTableRow(dataSet);
    }

  let selectized = $("#select-roll").selectize(selectizeOption);
  selectizedFocusAndClear(selectized);


 
});